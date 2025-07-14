<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Subject;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    //
    public function loadRegister()
    {
        if(Auth()->user() && Auth()->user()->is_admin == 1){
            return redirect('/admin/dashboard');
        }else if(Auth()->user() && Auth()->user()->is_admin == 0){
            return redirect('/manager/dashboard');
        }else if(Auth()->user() && Auth()->user()->is_admin == 2){
            return redirect('/analyst/dashboard');
        }else if(Auth()->user() && Auth()->user()->is_admin == 2){
            return redirect('/client/dashboard');
        }
        return view('register', ['pageTitle' => 'Register']);
    }

    public function managerAnalystRegister(Request $request){
        $request->validate([
            'name' => [
                'required',
                'string',
                'min:2',
                'max:100',
                'regex:/^[a-zA-Z\s]+$/',
            ],
            'email' => 'required|email|max:100|unique:users,email',
            'phone' => ['required', 'regex:/^[0-9]+$/', 'min:11', 'max:13'],
            'is_admin' => 'required|in:0,2,3',
            'password' => [
                'required',
                'confirmed',
                Password::min(4)
                    ->mixedCase()       
                    ->letters()         
                    ->numbers()         
                    ->symbols(),        
            ],
        ], [
            'name.regex' => 'The name may only contain letters and spaces.',
            'phone.regex' => 'The phone number may only contain digits.',
        ]);

        //dd($request);
        $user = new user;
        $user->name =  $request->name;
        $user->email =  $request->email;
        $user->phone = $request->phone;
        $user->is_admin = $request->is_admin;
        $user->password = $request->password; // Hash::make($request->password);
        $user->request_role = $request->is_admin;
        $user->request_decision = "NO";
        $user->is_active = "N";
        $user->is_delete = "Y";
        $user->save();

        return back()->with('success','Your registration has been successful.');
    }

    public function loadLogin(){
        if(Auth()->user()){
            if(Auth()->user()->request_decision == "YES" && Auth()->user()->is_active == "Y" && Auth()->user()->is_delete == "N"){
                if(Auth()->user() && Auth()->user()->is_admin == 1){
                    return redirect('/admin/dashboard');
                }else if(Auth()->user() && Auth()->user()->is_admin == 0){
                    return redirect('/manager/dashboard');
                }else if(Auth()->user() && Auth()->user()->is_admin == 2){
                    return redirect('/analyst/dashboard');
                }else if(Auth()->user() && Auth()->user()->is_admin == 3){
                    return redirect('/client/dashboard');
                }
            }else{
                return view('login', ['pageTitle' => 'Log in']);
            }
        }
        return view('login', ['pageTitle' => 'Log in']);
    }
    public function userLogin(Request $request){
        $request->validate([
            'email' => 'string|required|email',
            'password' => 'string|required',
        ]);
        // dd(Hash::make($request->password));
        
        $userCredential = $request->only('email','password');
        //dd(Auth::attempt($userCredential));
        if(Auth::attempt($userCredential)){
            //dd(Auth()->user()->is_admin);
            if(Auth()->user()->request_decision == "YES" && Auth()->user()->is_active == "Y" && Auth()->user()->is_delete == "N"){
                if(Auth()->user()->is_admin == 1){
                    return redirect('/admin/dashboard');
                }else if(Auth()->user()->is_admin == 0){
                    return redirect('/manager/dashboard');
                }else if(Auth()->user()->is_admin == 2){
                    return redirect('/analyst/dashboard');
                }else if(Auth()->user()->is_admin == 3){
                    return redirect('/client/dashboard');
                }
            }else{
                return back()->with('error','User is not active. Please contact admin');
            }
            
        }else{
            return back()->with('error','Username & password is incorrect.');
        }
        
    }
    // public function loadDashboard(){
    //     return view('manager.dashboard');
    // }
    public function analystDashboard(){
        return view('analyst.dashboard');
    }
    public function managerDashboard(){
        return view('manager.dashboard');
    }
    public function adminDashboard(){
        // $subjects = Subject::all();
        return view('admin.dashboard');
    }
    public function clientDashboard(){
        return view('client.dashboard');
    }

    public function logout(Request $request){
        $request->session()->flush();
        Auth::logout();
        return redirect('/');
    }

    public function forgetPasswordLoad()
    {
        return view('forget-password', ['pageTitle' => 'Forget Password']);
    }

    public function forgetPassword(Request $request){
        try{
            $user = User::where('email', $request->email)->get();
            // dd($user);
            if(count($user)> 0){
                $token = Str::random(40);
                $domain = URL::to('/');
                $url = $domain.'/reset-password?token='.$token;
                
                $data['url'] = $url;
                $data['email'] = $request->email;
                $data['title'] = 'Password Reset';
                $data['body'] = 'Please click on below link to reset your password';
                $data['link_text'] = 'Click here to reset password';

                Mail::send('forgetPasswordMail',['data'=>$data],function($message) use ($data){
                    $message->from('samin23ahmed@gmail.com', 'Md. Samin Ahmed');
                   $message->to($data['email'])->subject($data['title']);
                });

                $dateTime = Carbon::now()->format('Y-m-d H:i:s');
                PasswordReset::updateOrCreate(
                    ['email' => $request->email],
                    [
                        'email' => $request->email,
                        'token' => $token,
                        'created_at' => $dateTime
                    ]
                );
                return back()->with('success', 'Please check your mail to reset your password');

            }else{
                return back()->with('error', 'Email does not exist'); 
            }

        }catch(\Exception $e){
            return back()->with('error', $e->getMessage());
        }
    }

    public function resetPasswordLoad(Request $request){
        
        $resetData = PasswordReset::where('token',$request->token)->get();

        if(isset($request->token) && count($resetData)>0){
            $user = User::where('email',$resetData[0]['email'])->get();

            return view('resetPassword',compact('user'));
        }else{
            return view('404');
        }
    }

    public function resetPassword(Request $request){
        
        $request->validate([
            'password' => 'string|required|min:3|confirmed',
        ]);

        $user = User::find($request->id);
        $user->password = Hash::make($request->password);
        $user->save();

        PasswordReset::where('email',$user->email)->delete();

        return "<h2> Your password has been reset successfully. </h2>";

    }
}
