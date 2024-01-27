<?php

namespace App\Http\Features\Task;

use App\Http\Resources\Task\TaskAllCollection;
use App\Models\Task;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AllTaskFeature
{
    private Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function __invoke()
    {
        $tasks = Task::where('user_id', auth()->id())
            ->with('priority')
            ->with('type_task')
            ->with('status_task')
            ->get();

        // return response ()->json($tasks, Response::HTTP_OK);
        return response()->json(new TaskAllCollection($tasks), Response::HTTP_OK);
    }
}
