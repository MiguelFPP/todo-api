<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterUserController;
use App\Http\Controllers\Auth\ResendCodeController;
use App\Http\Controllers\Auth\VerifyUserController;
use Illuminate\Support\Facades\Route;

/* Route::post('/register', RegisterUserController::class); */

Route::prefix('auth')->group(function () {
    Route::post('/register', RegisterUserController::class)->name('v1.auth.register');
    Route::get('/verify/{code}', VerifyUserController::class)->name('v1.auth.verify');
    Route::post('/resend-code', ResendCodeController::class)->name('v1.auth.resend-code');
    Route::post('/login', LoginController::class)->name('v1.auth.login');
});
