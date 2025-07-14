<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;
use App\Models\User;
use App\Mail\GreetingMail;

class SendMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:send-greeting';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send greeting email to all users with reset password link';

    /**
     * Execute the console command.
     */
    
    

    public function handle()
    {
        $users = User::where('is_active', 'Y')->get(); 

        foreach ($users as $user) {
            $token = Str::random(40);
            //$domain = URL::to('/');
            //$url = $domain.'/login';
            $url = URL::to('/login');

            $data = [
                'url'   => $url,
                'email' => $user->email,
                'title' => 'Greetings! Daily Stock Update',
                'body'  => 'This is a greeting mail. Please click below to check current stock prices.',
                'link_text' => 'Click here to view stock prices',
            ];

            // Send mail
            Mail::send('forgetPasswordMail', ['data' => $data], function ($message) use ($data) {
                $message->from('samin23ahmed@gmail.com', 'Md. Samin Ahmed');
                $message->to($data['email'])->subject($data['title']);
            });
            
        }

        $this->info('Greeting emails sent successfully.');
    }
}
