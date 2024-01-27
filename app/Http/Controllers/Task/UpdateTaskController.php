<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Http\Features\Task\UpdateTaskFeature;
use App\Http\Requests\Task\StoreTaskRequest;
use Illuminate\Http\Request;

class UpdateTaskController extends Controller
{
    public function __invoke(StoreTaskRequest $request, int $id)
    {
        return dispatch_sync(new UpdateTaskFeature($request->all(), $id));
    }
}
