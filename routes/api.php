<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


require 'api/auth.php';
require 'api/user.php';
require 'api/priorities.php';
require 'api/type_task.php';
require 'api/status_task.php';
require 'api/task.php';
