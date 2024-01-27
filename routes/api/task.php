<?php

use App\Http\Controllers\Task\AllTaskController;
use App\Http\Controllers\Task\DeleteTaskController;
use App\Http\Controllers\Task\GetTaskController;
use App\Http\Controllers\Task\StoreTaskController;
use Illuminate\Support\Facades\Route;

Route::prefix('tasks')->middleware('auth:api')->group(function () {
    Route::get('/', AllTaskController::class)->name('v1.task.all');
    Route::get('/{id}', GetTaskController::class)->name('v1.task.get');
    Route::delete('/{id}', DeleteTaskController::class)->name('v1.task.delete');
    Route::post('/', StoreTaskController::class)->name('v1.task.store');
});
