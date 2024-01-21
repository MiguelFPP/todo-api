<?php

namespace App\Http\Services\Auth;

use App\Models\User;

class CreateCodeService
{
    /**
     * Generates a random verification code.
     *
     * @return string The generated verification code.
     */
    public function handle(User $user): string
    {
        do {
            $random = substr(
                str_shuffle(
                    str_repeat(
                        $x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
                        ceil(6 / strlen($x))
                    )
                ),
                1,
                6
            );
        } while (User::where('verification_code', $random)->exists());

        $user->verification_code = $random;
        $user->save();

        return $user->verification_code;
    }
}
