<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Features\Auth\RegisterUserFeature;
use App\Http\Requests\Auth\RegisterUserRequest;

class RegisterUserController extends Controller
{
    public function __invoke(RegisterUserRequest $request)
    {
        return dispatch_sync(new RegisterUserFeature($request->validated()));
    }
}
