<?php

use App\Http\Controllers\Homecontroller;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [Homecontroller::class, 'index'])->name('home');

// Usuário
Route::resource('users', UserController::class);

// Documentação da API
Route::get('/docs', fn () => view('swagger'))->name('docs');