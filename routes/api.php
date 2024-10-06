<?php

use App\Http\Controllers\BookingAppointmentController;
use App\Http\Controllers\DoctorInfoController;
use App\Http\Controllers\UserController;
use App\Models\BookingAppointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/forgot-password', [UserController::class, 'forgotPassword']);
Route::post('/reset-password', [UserController::class, 'resetPassword']);
Route::post('/verify-code', [UserController::class, 'verifyCode']);


Route::post('/doctor/register', [DoctorInfoController::class, 'register']);
Route::post('/doctor/login', [DoctorInfoController::class, 'login']);
Route::post('/doctor/forgot-password', [DoctorInfoController::class, 'forgotPassword']);
Route::post('/doctor/reset-password', [DoctorInfoController::class, 'resetPassword']);
Route::post('/doctor/verify-code', [DoctorInfoController::class, 'verifyCode']);


Route::post('/doctor/booking-appointment', [BookingAppointmentController::class, 'bookingAppointment']);
Route::post('/doctor/booking-payment', [BookingAppointmentController::class, 'bookingPayment']);