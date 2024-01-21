<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Features\Auth\ResendCodeFeature;
use Illuminate\Http\Request;

class ResendCodeController extends Controller
{
    public function __invoke(Request $request)
    {
        return dispatch_sync(new ResendCodeFeature($request));
    }
}
