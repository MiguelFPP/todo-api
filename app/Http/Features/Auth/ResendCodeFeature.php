<?php

namespace App\Http\Features\Auth;

use App\Http\Resources\ExceptionResource;
use App\Models\User;
use App\Notifications\Auth\VerificationCodeNotification;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class ResendCodeFeature
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function handle()
    {
        $this->data->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        try {
            $user = User::where('email', $this->data->email)
                ->whereNull('email_verified_at')
                ->first();

            if (!$user) {
                return response()->json([
                    'message' => 'Your account has been verified.',
                ], Response::HTTP_BAD_REQUEST);
            }

            $user->notify(new VerificationCodeNotification($user->verification_code));

            return response()->json([
                'message' => 'Verification code has been sent to your email.',
            ], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(new ExceptionResource($e), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
