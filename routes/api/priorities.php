<?php

use App\Http\Controllers\Priority\AllController;
use Illuminate\Support\Facades\Route;

/* with prefix and middleware auth */
Route::prefix('priorities')->middleware('auth:api')->group(function () {
    Route::get('/', AllController::class)->name('v1.priorities.index');
})->middleware('auth:api');
