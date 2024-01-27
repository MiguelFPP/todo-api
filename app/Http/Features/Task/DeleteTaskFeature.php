<?php

namespace App\Http\Features\Task;

use App\Http\Resources\MessageResponse;
use App\Models\Task;
use Symfony\Component\HttpFoundation\Response;

class DeleteTaskFeature
{
    private int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function handle()
    {
        $task = Task::where('id', $this->id)
            ->where('user_id', auth()->user()->id)
            ->first();

        if (!$task) {
            return response()->json(new MessageResponse('Task not found'), Response::HTTP_NOT_FOUND);
        }

        $task->delete();

        return response()->json(new MessageResponse('Task deleted successfully'), Response::HTTP_OK);
    }
}
