<?php

namespace App\Http\Controllers\TypeTask;

use App\Http\Controllers\Controller;
use App\Http\Features\TypeTask\TypesAllFeature;
use Illuminate\Http\Request;

class TypesAllController extends Controller
{
    public function __invoke()
    {
        return dispatch_sync(new TypesAllFeature());
    }
}
