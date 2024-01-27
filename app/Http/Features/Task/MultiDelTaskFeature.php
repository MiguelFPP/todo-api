<?php

namespace App\Http\Features\Task;

use App\Http\Resources\ExceptionResource;
use App\Http\Resources\MessageResponse;
use App\Models\Task;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class MultiDelTaskFeature
{
    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function handle()
    {
        try {
            $ids = $this->data['ids'];
            $tasks = Task::whereIn('id', $ids)
                ->where('user_id', auth()->user()->id)
                ->get();

            if (!$tasks) {
                return response()->json(new MessageResponse('Tasks not found'), Response::HTTP_NOT_FOUND);
            }

            $tasks->each(function ($task) {
                $task->delete();
            });

            return response()->json(new MessageResponse('Tasks deleted successfully'), Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(new ExceptionResource($e), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
