<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ChatController;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/add-coins', [HomeController::class, 'addCoins'])->name('add.coins');
});


Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/payment', [PaymentController::class, 'show'])->name('payment.show');
    Route::post('/payment', [PaymentController::class, 'process'])->name('payment.process');
    Route::post('/like/{user}', [HomeController::class, 'like'])->name('like.user');
    Route::post('/add-coins', [HomeController::class, 'addCoins'])->name('add.coins');
    Route::get('/search', [HomeController::class, 'search'])->name('search');
    Route::get('/chat/{user}', [ChatController::class, 'show'])->name('chat.show');
    Route::post('/chat/{user}', [ChatController::class, 'send'])->name('chat.send');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

