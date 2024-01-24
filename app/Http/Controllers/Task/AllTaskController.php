<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Http\Features\Task\AllTaskFeature;
use Illuminate\Http\Request;

class AllTaskController extends Controller
{
    public function __invoke(Request $request)
    {
        return dispatch_sync(new AllTaskFeature($request));
    }
}
