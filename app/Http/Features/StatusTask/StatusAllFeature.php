<?php
namespace App\Http\Features\StatusTask;

use App\Http\Resources\StatusTask\StatusAllCollection;
use App\Models\StatusTask;

class StatusAllFeature
{
    public function __invoke()
    {
        return response()->json(new StatusAllCollection(StatusTask::all()));
    }
}
