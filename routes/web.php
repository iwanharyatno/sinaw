<?php

use App\Http\Controllers\HomeController;
use Faker\Guesser\Name;
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