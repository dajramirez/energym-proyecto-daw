<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClassController;


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view ('dashboard');
    });
});

Route::get('/welcome', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'userDashboard'])->name('dashboard');
    
    Route::post('/classes/{class}/enroll', [ClassController::class, 'enroll'])->name('classes.enroll');
    Route::delete('/classes/{class}/unenroll', [ClassController::class, 'unenroll'])->name('classes.unenroll');

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);