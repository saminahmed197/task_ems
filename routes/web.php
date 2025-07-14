<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HoldingController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register',[AuthController::class,'loadRegister'])->name('register');
Route::post('/register',[AuthController::class,'managerAnalystRegister'])->name('managerAnalystRegister');
Route::get('/login',function(){
    return redirect('/');
});
Route::get('/',[AuthController::class,'loadLogin']);
Route::post('/login',[AuthController::class,'userLogin'])->name('userLogin');

Route::group(['middleware'=>['web','checkAdmin']],function(){
    Route::get('/admin/dashboard',[AuthController::class,'adminDashboard']);

    // Client Portfolio Management Route
    Route::get('/admin/clientlist',[AdminController::class,'clientlistDashboard'])->name('admin.clients.list');
    Route::post('/admin/clientlist/approve', [AdminController::class, 'approveSelectedClients'])->name('admin.clients.approve');
    Route::get('/admin/audit-logs', [AdminController::class, 'auditLog'])->name('audit.logs');

});

Route::group(['middleware' => ['web', 'checkAdminOrManager']], function (){
    // List of Holdings
    Route::get('/admin/client/holdings', [HoldingController::class,'index'])->name('admin.clientholdings.list');
    Route::get('/admin/client/holdings/create', [HoldingController::class,'create'])->name('admin.clientholdingscreate.list');
    Route::post('/admin/client/holdings/store', [HoldingController::class,'store'])->name('admin.clientholdingsstore.list');
    Route::put('/admin/client/holdings/update/{id}', [HoldingController::class,'update'])->name('admin.clientholdingsupdate.list');
    Route::post('/admin/client/holdings/delete/{id}', [HoldingController::class,'delete'])->name('admin.clientholdingsdelete.list');

    Route::get('/admin/upload-holdings', [HoldingController::class, 'loadStockuploadform'])->name('admin.loadStockuploadform');
    Route::post('/admin/upload-stock-all', [HoldingController::class, 'uploadStocks'])->name('admin.uploadStocks');
});

Route::group(['middleware' => ['web', 'CheckAdminOrAnalyst']], function (){
    // Report
    Route::get('/reports/equity-summary', [HoldingController::class, 'equitySummary'])->name('reports.equity.summary');
    Route::get('/reports/export/pdf', [HoldingController::class, 'exportPDF'])->name('reports.export.pdf');
    Route::get('/reports/export/excel', [HoldingController::class, 'exportExcel'])->name('reports.export.excel');

});

Route::group(['middleware'=>['web','checkManager']],function(){
    Route::get('/manager/dashboard',[AuthController::class,'managerDashboard']);
});

Route::group(['middleware'=>['web','checkAnalyst']],function(){
    Route::get('/analyst/dashboard',[AuthController::class,'analystDashboard']);

});

Route::group(['middleware'=>['web','checkClient']],function(){
    Route::get('/client/dashboard',[AuthController::class,'clientDashboard']);
});

Route::get('/default/stock/dashboard',[HoldingController::class,'allStoredStocks'])->name('stock.allStoredStocks');

Route::get('/logout',[AuthController::class,'logout']);

Route::get('/forget-password',[AuthController::class,'forgetPasswordLoad']);
Route::post('/forget-password',[AuthController::class,'forgetPassword'])->name('forgetPassword');
Route::get('/reset-password',[AuthController::class,'resetPasswordLoad']);
Route::post('/reset-password',[AuthController::class,'resetPassword'])->name('resetPassword');


// Route::get('/admin/store/stocks/dse', [HoldingController::class, 'getallStockdse']);
// Route::get('/admin/store/stocks/dse/data', [HoldingController::class, 'stockPricescheduler']);
