<?php

namespace App\Http\Features\Auth;

use App\Http\Const\ConstSettings;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\Auth\LoginResource;
use App\Http\Resources\ExceptionResource;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class LoginFeature
{
    private LoginRequest $data;

    public function __construct(LoginRequest $data)
    {
        $this->data = $data;
    }

    public function handle()
    {
        try {
            $credentials = $this->data->only('email', 'password');

            if (!auth()->attempt($credentials)) {
                return response()->json([
                    'message' => 'Invalid credentials.',
                ], Response::HTTP_UNAUTHORIZED);
            }

            return response()->json(new LoginResource(auth()->user()), Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(new ExceptionResource($e), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
