<?php

namespace App\Http\Features\Priority;

use App\Http\Resources\Priority\PriorityAllCollection;
use App\Models\Priority;
use Symfony\Component\HttpFoundation\Response;

class PriorityAllFeature
{
    public function __invoke()
    {
        return response()->json(new PriorityAllCollection(Priority::all()), Response::HTTP_OK);
    }
}
