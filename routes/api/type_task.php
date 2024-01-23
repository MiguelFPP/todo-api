<?php

use App\Http\Controllers\TypeTask\TypesAllController;
use Illuminate\Support\Facades\Route;

Route::prefix('types')->middleware('auth:api')->group(function () {
    Route::get('/', TypesAllController::class)->name('v1.types.all');
});
