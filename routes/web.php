<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\RegisterController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProfileController;
use \App\Http\Controllers\Site\HomeController as SiteHomeController;


// Rota principal
Route::get('/', [SiteHomeController::class, 'index'])->name('site.home');

// Grupo de rotas para o admin
Route::prefix('painel')->name('painel.')->group(function () {

    // Rotas para usuários não autenticados
    Route::middleware(['guest'])->group(function () {

        // Rota para login
        Route::controller(LoginController::class)->group(function () {
            Route::get('login', 'index')->name('login');
            Route::post('login', 'authenticate');
        });

        //  Rota para cadastro
        Route::controller(RegisterController::class)->group(function () {
            Route::get('register', 'index')->name('register');
            Route::post('register', 'register');
        });
    });

    // Rotas para usuários autenticados
    Route::middleware(['auth'])->group(function () {

        // Rota para home
        Route::controller(HomeController::class)->group(function () {
            Route::get('/', 'index')->name('home');
        });

        // Rota para logout
        Route::post('logout', [LoginController::class, 'logout'])->name('logout');

        Route::middleware(['admin', 'can:admin'])->group(function () {
            //Rotas para usuários
            Route::prefix('users')->name('users.')->group(function () {
                Route::controller(UserController::class)->group(function () {
                    Route::get('/', 'index')->name('list');
                    Route::get('create', 'create')->name('create');
                    Route::post('/', 'store')->name('store');
                    Route::get('edit/{id}', 'edit')->name('edit');
                    Route::put('edit/{id}', 'update')->name('update');
                    Route::delete('delete/{id}', 'destroy')->name('delete');
                });
            });
            //Rotas para perfil
            Route::get('profile', [ProfileController::class, 'index'])->name('profile');
            Route::put('profile-update', [ProfileController::class, 'update'])->name('profile.update');
        });
    });
});
