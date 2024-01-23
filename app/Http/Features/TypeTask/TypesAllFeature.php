<?php

namespace App\Http\Features\TypeTask;

use App\Http\Resources\TypeTask\TypesAllCollection;
use App\Models\TypeTask;

class TypesAllFeature
{
    public function __invoke()
    {
        return response()->json(new TypesAllCollection(TypeTask::all()));
    }
}
