<?php

namespace App\Http\Features\Task;

use App\Http\Requests\Task\GetTaskRequest;
use App\Http\Resources\Task\TaskGetResource;
use App\Models\Task;
use Symfony\Component\HttpFoundation\Response;

class GetTaskFeature
{
    private int $data;

    public function __construct(int $data)
    {
        $this->data = $data;
    }

    public function handle()
    {
        $task = Task::where('user_id', auth()->id())
            ->where('id', $this->data)
            ->with('priority')
            ->with('type_task')
            ->with('status_task')
            ->first();

        if (!$task) {
            return response()->json([
                'message' => 'Task not found'
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json(new TaskGetResource($task), Response::HTTP_OK);
    }
}
