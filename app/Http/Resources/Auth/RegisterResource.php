<?php

namespace App\Http\Resources\Auth;

use App\Http\Const\ConstSettings;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RegisterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $info_token = $this->createToken('auth_token')->accessToken;
        return [
            'name' => $this->name,
            'email' => $this->email,
            'token' => $info_token,
            'token_type' => 'Bearer',
            'expire_token_in' => ConstSettings::EXPIRE_TOKEN,
        ];
    }
}
