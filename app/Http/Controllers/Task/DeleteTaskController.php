<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Http\Features\Task\DeleteTaskFeature;
use Illuminate\Http\Request;

class DeleteTaskController extends Controller
{
    public function __invoke(int $id)
    {
        return dispatch_sync(new DeleteTaskFeature($id));
    }
}
