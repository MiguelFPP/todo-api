<?php

namespace App\Http\Features\Task;

use App\Http\Resources\ExceptionResource;
use App\Http\Resources\MessageResponse;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class StatusTaskFeature
{
    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function handle()
    {
        try {
            $task = auth()->user()->tasks()->where('id', $this->data['id'])->first();

            if (!$task) {
                return response()->json(new MessageResponse('Task not found'), Response::HTTP_NOT_FOUND);
            }

            $task->update([
                'status_task_id' => $this->data['status_task_id']
            ]);

            return response()->json(new MessageResponse('Task status updated'), Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(new ExceptionResource($e), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
