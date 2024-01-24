<?php

use App\Http\Controllers\Task\AllTaskController;
use Illuminate\Support\Facades\Route;

Route::prefix('tasks')->middleware('auth:api')->group(function () {
    Route::get('/', AllTaskController::class)->name('v1.task.all');
});
