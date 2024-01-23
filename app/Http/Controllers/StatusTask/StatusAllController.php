<?php

namespace App\Http\Controllers\StatusTask;

use App\Http\Controllers\Controller;
use App\Http\Features\StatusTask\StatusAllFeature;
use Illuminate\Http\Request;

class StatusAllController extends Controller
{
    public function __invoke()
    {
        return dispatch_sync(new StatusAllFeature());
    }
}
