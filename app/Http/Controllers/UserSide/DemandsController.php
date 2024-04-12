<?php

namespace App\Http\Controllers\UserSide;

use App\Http\Controllers\Controller;
use App\Models\Demand;
use App\Http\Requests\createDemandRequest;

class DemandsController extends Controller
{
    public function index()
    {
        # code...
    }

    public function store(createDemandRequest $request)
    {
        # code...
    }

    public function show(Demand $demand)
    {
        # code...
    }
}
