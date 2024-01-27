<?php

use App\Http\Controllers\Task\AllTaskController;
use App\Http\Controllers\Task\DeleteTaskController;
use App\Http\Controllers\Task\GetTaskController;
use App\Http\Controllers\Task\MultiDelTaskController;
use App\Http\Controllers\Task\StatusTaskController;
use App\Http\Controllers\Task\StoreTaskController;
use App\Http\Controllers\Task\UpdateTaskController;
use Illuminate\Support\Facades\Route;

Route::prefix('tasks')->middleware('auth:api')->group(function () {
    Route::get('/', AllTaskController::class)->name('v1.task.all');
    Route::get('/{id}', GetTaskController::class)->name('v1.task.get');
    Route::delete('/{id}', DeleteTaskController::class)->name('v1.task.delete');
    Route::post('/', StoreTaskController::class)->name('v1.task.store');
    Route::put('/{id}', UpdateTaskController::class)->name('v1.task.update');
    Route::post('/multiple-delete', MultiDelTaskController::class)->name('v1.task.multi-del');
    Route::patch('/status', StatusTaskController::class)->name('v1.task.status.update');
});
