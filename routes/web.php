<?php

use App\Http\Controllers\AktivitasController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\NongkrongController;
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
    Route::get('/kuis', 'index')-> name ('quiz.index');

    Route::middleware('auth')->group(function() {
        Route::get('/kuis/new', 'create')->name('quiz.create');
        Route::post('/kuis/new', 'store')->name('quiz.store');
        Route::get('/kuis/mine', 'indexMine')->name('quiz.index-mine');

        Route::get('/kuis/edit/{id}', 'edit')->name('quiz.edit');
        Route::post('/kuis/delete/{id}', 'delete')->name('quiz.delete');
        Route::post('/kuis/update/{id}', 'update')->name('quiz.update');
    });
    
    Route::get('/kuis/{id}', 'show')->name('quiz.show');
});

Route::controller(KelasController::class)->middleware('auth')->group(function() {
    Route::get('/kelas', 'index')-> name ('kelas.index');
});
Route::controller(NongkrongController::class)->group(function() {
    Route::get('/nongkrong', 'index')-> name ('nongkrong.index');
});
Route::controller(AktivitasController::class)->group(function() {
    Route::get('/aktivitas', 'index')-> name ('aktivitas.index');
});