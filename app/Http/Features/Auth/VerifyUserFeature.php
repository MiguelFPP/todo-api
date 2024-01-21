<?php

namespace App\Http\Features\Auth;

use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

class VerifyUserFeature
{
    private string $code;

    public function __construct(string $code)
    {
        $this->code = $code;
    }

    public function handle()
    {
        $user = User::where('verification_code', $this->code)
            ->whereNull('email_verified_at')
            ->first();

        if (!$user) {
            return response()->json(['message' => 'Invalid code'], Response::HTTP_BAD_REQUEST);
        }

        $user->update([
            'email_verified_at' => now(),
            'verification_code' => null
        ]);

        return response()->json(['message' => 'User verified'], Response::HTTP_OK);
    }
}
