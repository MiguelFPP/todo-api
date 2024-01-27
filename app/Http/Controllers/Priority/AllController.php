<?php

namespace App\Http\Controllers\Priority;

use App\Http\Controllers\Controller;
use App\Http\Features\Priority\PriorityAllFeature;
use Illuminate\Http\Request;

class AllController extends Controller
{
    public function __invoke()
    {
        return dispatch_sync(new PriorityAllFeature());
    }
}
