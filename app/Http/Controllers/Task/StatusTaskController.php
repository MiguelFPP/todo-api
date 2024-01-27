<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Http\Features\Task\StatusTaskFeature;
use App\Http\Requests\Task\StatusTaskRequest;
use Illuminate\Http\Request;

class StatusTaskController extends Controller
{
    public function __invoke(StatusTaskRequest $request)
    {
        return dispatch_sync(new StatusTaskFeature($request->all()));
    }
}
