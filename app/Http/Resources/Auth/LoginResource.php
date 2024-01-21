<?php

namespace App\Http\Resources\Auth;

use App\Http\Const\ConstSettings;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'token' => $this->createToken('auth_token')->accessToken,
            'token_type' => 'Bearer',
            'expire_token_in' => ConstSettings::EXPIRE_TOKEN,
        ];
    }
}
