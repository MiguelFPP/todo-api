<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Features\Auth\LogoutFeature;

class LogoutController extends Controller
{
    public function __invoke()
    {
        return dispatch_sync(new LogoutFeature());
    }
}
