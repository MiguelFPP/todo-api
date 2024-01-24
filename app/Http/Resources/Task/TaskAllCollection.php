<?php

namespace App\Http\Resources\Task;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TaskAllCollection extends ResourceCollection
{
    public $collects = TaskAllResource::class;
}
