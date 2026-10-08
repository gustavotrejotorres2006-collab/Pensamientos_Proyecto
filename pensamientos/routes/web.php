<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('login'));

Route::middleware('guest.custom')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
    Route::get('/registro', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/registro', [AuthController::class, 'register'])->name('register.store');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth.custom')
    ->name('logout');

Route::middleware('auth.custom')->group(function () {
    Route::get('/inicio', [HomeController::class, 'index'])->name('home');

    Route::get('/publicar', [PostController::class, 'create'])->name('posts.create');
    Route::post('/publicar', [PostController::class, 'store'])->name('posts.store');
    Route::get('/publicacion/{post}', [PostController::class, 'show'])->name('posts.show');
    Route::get('/publicacion/{post}/editar', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/publicacion/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/publicacion/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

    Route::get('/buscar', [SearchController::class, 'index'])->name('search');
    Route::get('/perfil/{user}', [ProfileController::class, 'show'])->name('profile.show');
});
