<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Http\Features\Task\GetTaskFeature;

class GetTaskController extends Controller
{
    public function __invoke(int $id)
    {
        return dispatch_sync(new GetTaskFeature($id));
    }
}
