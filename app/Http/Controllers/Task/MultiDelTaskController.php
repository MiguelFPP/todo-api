<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Http\Features\Task\MultiDelTaskFeature;
use App\Http\Requests\Task\MultiDelTaskRequest;

class MultiDelTaskController extends Controller
{
    public function __invoke(MultiDelTaskRequest $request)
    {
        return dispatch_sync(new MultiDelTaskFeature($request->all()));
    }
}
