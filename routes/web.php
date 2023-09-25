<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\otpController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('otp');
});
Route::get('/send-otp', [otpController::class, 'sendOTP']);
Route::post('/verify-otp', [otpController::class, 'verifyOTP']);
Route::get('/cancel-otp', [otpController::class, 'cancelOTP']);