<?php

namespace App\Http\Resources\Priority;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PriorityAllCollection extends ResourceCollection
{
    public $collects = PriorityAllResource::class;
}
