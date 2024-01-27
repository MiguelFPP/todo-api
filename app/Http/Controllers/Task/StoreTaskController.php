<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Http\Features\Task\StoreTaskFeature;
use App\Http\Requests\Task\StoreTaskRequest;
use Illuminate\Http\Request;

class StoreTaskController extends Controller
{
    public function __invoke(StoreTaskRequest $request)
    {
        return dispatch_sync(new StoreTaskFeature($request->all()));
    }
}
