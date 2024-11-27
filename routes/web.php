<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuizController;
use Illuminate\Support\Facades\Route;

Route::controller(HomeController::class)->group(function() {
    Route::get('/', 'index')->name('home.index');

    Route::get('/register', 'register')->name('home.register');
    Route::post('/register', 'handleRegister')->name('home.handle-register');

    Route::get('/login', 'login')->name('home.login');
    Route::post('/login', 'handleLogin')->name('home.handle-login');

    Route::middleware('auth')->group(function() {
        Route::post('/logout', 'logout')->name('home.logout');
    });
});
Route::controller(QuizController::class)->group(function() {
    Route::get('/kuis', 'index');
});
