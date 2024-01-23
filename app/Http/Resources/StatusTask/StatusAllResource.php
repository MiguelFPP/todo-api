<?php

namespace App\Http\Resources\StatusTask;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StatusAllResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'is_active' => $this->is_active
        ];
    }
}
