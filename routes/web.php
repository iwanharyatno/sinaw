<?php

use App\Http\Controllers\AktivitasController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\NongkrongController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home.index');

    Route::get('/register', 'register')->name('home.register');
    Route::post('/register', 'handleRegister')->name('home.handle-register');

    Route::get('/login', 'login')->name('home.login');
    Route::post('/login', 'handleLogin')->name('home.handle-login');

    Route::middleware('auth')->group(function () {
        Route::post('/logout', 'logout')->name('home.logout');
    });
});

Route::controller(QuizController::class)->group(function () {
    Route::get('/kuis', 'index')->name('quiz.index');

    Route::middleware('auth')->group(function () {
        Route::get('/kuis/new', 'create')->name('quiz.create');
        Route::post('/kuis/new', 'store')->name('quiz.store');
        Route::get('/kuis/mine', 'indexMine')->name('quiz.index-mine');

        Route::get('/kuis/edit/{id}', 'edit')->name('quiz.edit');
        Route::post('/kuis/delete/{id}', 'delete')->name('quiz.delete');
        Route::post('/kuis/update/{id}', 'update')->name('quiz.update');

        Route::get('/kuis/join/{id}', 'join')->name('quiz.join');
        Route::post('/kuis/join/{id}', 'attempt')->name('quiz.attempt');
        Route::get('/kuis/play/{id}', 'play')->name('quiz.play');
        

        Route::post('/kuis/change-visibility/{id}', 'changeVisibility')->name('quiz.change-visibility');
        Route::post('/kuis/join', 'joinUsingCode')->name('quiz.join-code');
    });
   
    Route::get('/kuis/{id}', 'show')->name('quiz.show');
});

Route::controller(KelasController::class)->middleware('auth')->group(function () {
    Route::get('/kelas', 'index')->name('kelas.index');
});
Route::controller(NongkrongController::class)->group(function () {
    Route::get('/nongkrong', 'index')->name('nongkrong.index');

    Route::get('/nongkrong/{threadId}/replies', 'reply')->name('nongkrong.reply');
    Route::middleware('auth')->group(function () {
        Route::get('/nongkrong/create', 'create')->name('nongkrong.create');
        Route::get('/nongkrong/mine', 'mine')->name('nongkrong.mine');
        Route::post('/nongkrong/create', 'store')->name('nongkrong.store');
        Route::post('/nongkrong/{threadId}/replies', 'storeReply')->name('nongkrong.store-reply');
    });
});
Route::controller(AktivitasController::class)->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('/aktivitas', 'index')->name('aktivitas.index');
    });
});

Route::controller(UserController::class)->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('profile', 'editProfile')->name('user.profile');
        Route::post('profile', 'saveProfile')->name('user.profile-save');
    });
});

Route::get('/image/{path}', function($path) {
    $img = Storage::disk('google')->get($path);
    $ext = explode('.', $path)[1];
    return response($img)->header('Content-type', 'image/' . $ext);
});