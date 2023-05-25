<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/login', function () {
    return view('login');
})->name('iams.login');

Route::get('/register', function () {
    return view('register');
})->name('iams.register');

Route::get('/forgot-password', function () {
    return view('forgotpassword');
})->name('iams.forgotpassword');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('iams.dashboard');

Route::get('/table', function () {
    return view('table');
})->name('iams.table');
