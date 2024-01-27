<?php

namespace App\Http\Features\TypeTask;

use App\Http\Resources\TypeTask\TypesAllCollection;
use App\Models\TypeTask;
use Symfony\Component\HttpFoundation\Response;

class TypesAllFeature
{
    public function __invoke()
    {
        return response()->json(new TypesAllCollection(TypeTask::all()), Response::HTTP_OK);
    }
}
