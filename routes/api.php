<?php

use App\Http\Controllers\AttendantController;
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


Route::post('/v1/doctor/register', [DoctorInfoController::class, 'register']);
Route::post('/v1/doctor/login', [DoctorInfoController::class, 'login']);
// Route::post('/v1/doctor/forgot-password', [DoctorInfoController::class, 'forgotPassword']);
// Route::post('/v1/doctor/reset-password', [DoctorInfoController::class, 'resetPassword']);
// Route::post('/v1/doctor/verify-code', [DoctorInfoController::class, 'verifyCode']);


Route::post('/v1/doctor/booking-appointment', [BookingAppointmentController::class, 'bookingAppointment']);
Route::post('/v1/doctor/booking-payment', [BookingAppointmentController::class, 'bookingPayment']);


// attendant api
Route::post('/v1/attendant/register', [AttendantController::class, 'register']);
Route::post('/v1/attendant/login', [AttendantController::class, 'login']);
// Route::post('/v1/attendant/forgot-password', [AttendantController::class, 'forgotPassword']);
// Route::post('/v1/attendant/reset-password', [AttendantController::class, 'resetPassword']);
// Route::post('/v1/attendant/verify-code', [AttendantController::class, 'verifyCode']);
