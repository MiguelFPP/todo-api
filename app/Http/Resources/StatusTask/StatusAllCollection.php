<?php

namespace App\Http\Resources\StatusTask;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class StatusAllCollection extends ResourceCollection
{
    public $collects = StatusAllResource::class;
}
