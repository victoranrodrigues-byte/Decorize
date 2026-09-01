<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('landing');
});

Route::get('/login', [UserController::class, 'showLogin'])->name('login');
Route::post('/login', [UserController::class, 'login']);

Route::get('/registrar', [UserController::class, 'showRegister'])->name('registrar');
Route::post('/registrar', [UserController::class, 'register']);

Route::get('/docs-api', function () {
    return view('api');
})->name('api.docs');

Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/home', function () {
    return view('home');
})->middleware('auth')->name('home');
