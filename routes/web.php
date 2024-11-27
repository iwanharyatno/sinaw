<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuizController;
use Illuminate\Support\Facades\Route;

Route::controller(HomeController::class)->group(function() {
    Route::get('/', 'index');
    Route::get('/register', 'register');

    // Handle login
    Route::post('/register', 'handleRegister')->name('home.handle-register');
    Route::get('/login', 'login');
});
Route::controller(QuizController::class)->group(function() {
    Route::get('/kuis', 'index');
});
