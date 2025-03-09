<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TrainerController;
use App\Http\Controllers\ClerkController;


Route::get('/', function() {
    return view('/welcome');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function() {
    Route::prefix('user')->group(function () {
        Route::get('/dashboard', [UserController::class, 'userDashboard'])->name('user.dashboard');
        Route::post('/classes/{class}/enroll', [UserController::class, 'enroll'])->name('classes.enroll');
        Route::delete('/classes/{class}/unenroll', [UserController::class, 'unenroll'])->name('classes.unenroll');
    });

    Route::prefix('trainer')->group(function(){
        Route::get('/dashboard', [TrainerController::class, 'trainerDashboard'])->name('trainer.dashboard');
        Route::get('/classes/create', [TrainerController::class, 'createClass'])->name('trainer.classes.create');
        Route::post('/classes', [TrainerController::class, 'storeClass'])->name('trainer.classes.store');
        Route::get('/classes/{class}/edit', [TrainerController::class, 'editClass'])->name('trainer.classes.edit');
        Route::put('/classes/{class}', [TrainerController::class, 'updateClass'])->name('trainer.classes.update');
        Route::delete('/classes/{class}/delete', [TrainerController::class, 'deleteClass'])->name('trainer.classes.delete');
    });

    Route::prefix('clerk')->group(function() {
        Route::get('/dashboard', [ClerkController::class, 'clerkDashboard'])->name('clerk.dashboard');
        Route::get('/users/create', [ClerkController::class, 'createUser'])->name('clerk.users.create');
        Route::post('/users', [ClerkController::class, 'storeUser'])->name('clerk.users.store');
        Route::get('/users/{user}/edit', [ClerkController::class, 'editUser'])->name('clerk.users.edit');
        Route::put('/users/{user}', [ClerkController::class, 'updateUser'])->name('clerk.users.update');
        Route::delete('/users/{user}/delete', [ClerkController::class, 'deleteUser'])->name('clerk.users.delete');
    });
});