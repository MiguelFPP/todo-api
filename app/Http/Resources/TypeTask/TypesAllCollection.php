<?php

namespace App\Http\Resources\TypeTask;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TypesAllCollection extends ResourceCollection
{
    public $collects = TypesAllResource::class;
}
