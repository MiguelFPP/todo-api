<?php

namespace App\Http\Features\Task;

use App\Http\Resources\MessageResponse;
use App\Models\Task;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class StoreTaskFeature
{
    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function handle()
    {
        try {
            $task = Task::create([
                'title' => $this->data['title'],
                'description' => $this->data['description'],
                'priority_id' => $this->data['priority_id'],
                'type_task_id' => $this->data['type_task_id'],
                'status_task_id' => $this->data['status_task_id'],
                'user_id' => auth()->user()->id,
            ]);

            if (!$task) {
                return response()->json(new MessageResponse('Error to create task'), Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            return response()->json(new MessageResponse('Task created successfully'), Response::HTTP_CREATED);

        } catch (Exception $e) {
            return response()->json(new Exception($e), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
