<?php

namespace App\Http\Features\Auth;

use App\Http\Resources\ExceptionResource;
use App\Http\Resources\MessageResponse;
use Exception;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LogoutFeature
{
    public function handle()
    {
        try {
            $user = Auth::user()->token();

            if ($user->revoke()) {
                return response()->json(new MessageResponse('Logout success'), Response::HTTP_OK);
            }

            return response()->json(new MessageResponse('Logout failed'), Response::HTTP_BAD_REQUEST);
        } catch (Exception $e) {
            return response()->json(new ExceptionResource($e), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
