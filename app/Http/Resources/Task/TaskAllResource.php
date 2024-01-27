<?php

namespace App\Http\Resources\Task;

use App\Http\Resources\Priority\PriorityAllResource;
use App\Http\Resources\StatusTask\StatusAllResource;
use App\Http\Resources\TypeTask\TypesAllResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskAllResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'priority' => new PriorityAllResource($this->priority),
            'type_task' => new TypesAllResource($this->type_task),
            'status_task' => new StatusAllResource($this->status_task),
            'created_at' => Carbon::parse($this->created_at)->diffForHumans(),
            'updated_at' => Carbon::parse($this->updated_at)->diffForHumans(),
        ];
    }
}
