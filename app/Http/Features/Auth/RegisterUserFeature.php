<?php

namespace App\Http\Features\Auth;

use App\Http\Resources\Auth\RegisterResource;
use App\Http\Resources\ExceptionResource;
use App\Http\Services\Auth\CreateCodeService;
use App\Models\User;
use App\Notifications\Auth\VerificationCodeNotification;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class RegisterUserFeature
{
    /**
     * @var array<string, string>
     */
    private array $data;

    /**
     * @param array<string, string> $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function handle()
    {
        try {
            $user = User::create($this->data);

            $code = (new CreateCodeService())->handle($user);

            $user->notify(new VerificationCodeNotification($code));

            return response()->json(new RegisterResource($user), Response::HTTP_CREATED);
        } catch (Exception $e) {
            return response()->json(new ExceptionResource($e), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
