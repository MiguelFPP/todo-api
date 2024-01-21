<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Features\Auth\VerifyUserFeature;
use Illuminate\Http\Request;

class VerifyUserController extends Controller
{
    public function __invoke(Request $request, string $code)
    {
        return dispatch_sync(new VerifyUserFeature($code));
    }
}
