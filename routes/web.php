<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\RegisterController;
use App\Http\Controllers\Admin\HomeController;
use Illuminate\Support\Facades\Route;

// Rota principal
Route::get('/', [\App\Http\Controllers\Site\HomeController::class, 'index'])->name('site.home');

// Grupo de rotas para o admin
Route::prefix('admin')->name('admin.')->group(function () {
    // Rotas para usuários não autenticados
    Route::middleware(['guest'])->group(function () {
        Route::controller(LoginController::class)->group(function () {
            Route::get('login', 'index')->name('login');
            Route::post('login', 'authenticate');
        });
        Route::controller(RegisterController::class)->group(function () {
            Route::get('register', 'index')->name('register');
            Route::post('register', 'register');
        });
    });

    // Rotas para usuários autenticados
    Route::middleware(['auth'])->group(function () {
        Route::controller(HomeController::class)->group(function () {
            Route::get('/', 'index')->name('home');
        });
        Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    });
});
