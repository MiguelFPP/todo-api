<?php

use App\Http\Controllers\StatusTask\StatusAllController;
use Illuminate\Support\Facades\Route;

Route::prefix('status')->middleware('auth:api')->group(function () {
    Route::get('/', StatusAllController::class)->name('v1.status.all');
});
