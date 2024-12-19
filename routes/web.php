<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Reservasi\ReservasiController;
use App\Http\Controllers\Chat\ChatController;
use App\Http\Controllers\Profile\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () { 
    return view('welcome'); 
});

Route::controller(AuthController::class)->group(function () {
    Route::get('login', 'index')->name('login');
    Route::post('login', 'postLogin')->name('login.post');
    Route::post('logout', 'logout')->name('logout');
    Route::get('register', 'registration')->name('register');
    Route::post('register', 'postRegistration')->name('register.post');
});

Route::get('forgot-password', [AuthController::class, 'forgot_password'])->name('forgot_password');
Route::post('forgot-password-act', [AuthController::class, 'forgot_password_act'])->name('forgot_password_act');

Route::get('validasi-forgot-password/{token}', [AuthController::class, 'validasi_forgot_password'])->name('validasi_forgot_password');
Route::post('validasi-forgot-password-act', [AuthController::class, 'validasi_forgot_password_act'])->name('validasi_forgot_password_act');

Route::middleware(['auth'])->group(function () {
    Route::get('homepage', [AuthController::class, 'homepage'])->name('homepage');
});

Route::prefix('reservasi')->name('reservasi.')->group(function () {
    Route::get('index', [ReservasiController::class, 'index'])->name('index');
    Route::get('status', [ReservasiController::class, 'showStatus'])->name('status');
    Route::post('status', [ReservasiController::class, 'store'])->name('store');
    Route::get('meja/{id}', [ReservasiController::class, 'getMejaDetails'])->name('mejaDetails');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/forum/chat', [ChatController::class, 'index'])->name('chat');
    Route::get('/chat/fetch', [ChatController::class, 'fetchMessages'])->name('chat.fetch');
    Route::post('/forum/chat/send', [ChatController::class, 'sendMessage'])->name('chat.send');
});

Route::get('/leaderboard', function () {
    return view('leaderboard.leaderboard');
})->name('leaderboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});
