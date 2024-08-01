<?php

use App\Http\Controllers\LoanController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
