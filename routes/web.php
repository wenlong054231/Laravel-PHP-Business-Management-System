<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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

Route::get('/login', [UserController::class, 'login'])->name('user.login');
Route::get('/register', [UserController::class, 'register'])->name('user.register');
Route::post('/register', [UserController::class, 'registerUser'])->name('user.registerUser');
Route::post('/login', [UserController::class, 'loginUser'])->name('user.loginUser');
Route::post('/logout', [UserController::class, 'logout'])->name('user.logout');

Route::post('/forgotpassword', [UserController::class, 'sendPasswordResetEmail'])->name('user.requestpasswordreset');
Route::get('/resetpassword',[UserController::class, 'passwordResetEmail'])->name('user.passwordResetEmail');

Route::get('/home',[UserController::class, 'home'])->name('staff.home');
Route::get('/clientlist',[UserController::class, 'clientlist'])->name('staff.client');
Route::get('/clientadd',[UserController::class, 'clientadd'])->name('staff.clientadd');
Route::get('/policy',[UserController::class, 'policylist'])->name('staff.policy');

Route::get('/forgot-password', function () {
    return view('user.forgotpassword');
})->name('user.forgotpassword');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('admin')->name('admin.dashboard');


// Route::get('/email/verify', function () {
//     return view('auth.verify-email');
// })->name('verification.notice');

// Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
//     $request->fulfill();
 
//     return redirect()->route('admin.dashboard');
// })->middleware(['auth', 'signed'])->name('verification.verify');

// Route::post('/email/verification-notification', function (Request $request) {
//     $request->user()->sendEmailVerificationNotification();
 
//     return back()->with('message', 'Verification link sent!');
// })->middleware(['auth', 'throttle:6,1'])->name('verification.send');