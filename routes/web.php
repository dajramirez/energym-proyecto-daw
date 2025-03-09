<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TrainerController;


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
        Route::delete('/classes/{class}/delete', [TrainerController::class, 'destroyClass'])->name('trainer.classes.delete');
    });
});

// Route::middleware('auth')->group(function () {
//     Route::get('/dashboard', function () {
//         return view ('dashboard');
//     });
// });

// Route::get('/welcome', function () {
//     return view('welcome');
// });

// Route::middleware(['auth'])->group(function () {
//     Route::get('/dashboard', [DashboardController::class, 'userDashboard'])->name('dashboard.user');
    
//     Route::prefix('trainer')->group(function () {
//         Route::get('/classes', [TrainerController::class, 'index'])->name('trainer.classes');
//         Route::get('/classes/create', [TrainerController::class, 'create'])->name('trainer.classes.create');
//         Route::post('/classes', [TrainerController::class, 'store'])->name('trainer.classes.store');
//         Route::get('/classes/{class}/edit', [TrainerController::class, 'edit'])->name('trainer.classes.edit');
//         Route::put('/classes/{class}', [TrainerController::class, 'update'])->name('trainer.classes.update');
//         Route::delete('/classes/{class}/delete', [TrainerController::class, 'destroy'])->name('trainer.classes.delete');
//     });

//     Route::post('/classes/{class}/enroll', [ClassController::class, 'enroll'])->name('classes.enroll');
//     Route::delete('/classes/{class}/unenroll', [ClassController::class, 'unenroll'])->name('classes.unenroll');

//     Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
// });

// Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
// Route::post('/register', [RegisterController::class, 'register']);

// Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
// Route::post('/login', [LoginController::class, 'login']);