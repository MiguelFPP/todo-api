<?php

namespace App\Http\Features\Task;

use App\Http\Resources\ExceptionResource;
use App\Http\Resources\MessageResponse;
use App\Models\Task;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class UpdateTaskFeature
{
    private array $data;
    private int $id;

    public function __construct(array $data, int $id)
    {
        $this->data = $data;
        $this->id = $id;
    }

    public function handle()
    {
        try {
            $task = Task::where('id', $this->id)
                ->where('user_id', auth()->user()->id)
                ->first();

            if (!$task) {
                return response()->json(new MessageResponse('Task not found'), Response::HTTP_NOT_FOUND);
            }

            $task->update($this->data);

            return response()->json(new MessageResponse('Task updated successfully'), Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(new ExceptionResource($e), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
