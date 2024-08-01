<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\LoanController;

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
    return view('auth.login');
});

// Route::redirect('/register','/login');

Route::controller(LoanController::class)->group(function(){
    Route::get('loan-details','loan_details');
    Route::get('process-data','process_data');
    Route::get('process-emi','process_emi')->name('emi.data');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/clear', function() {
   
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    // Artisan::call('optimize');
 
    return "Cleared!";
 
 });
 
