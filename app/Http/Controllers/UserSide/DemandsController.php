<?php

namespace App\Http\Controllers\UserSide;

use App\Models\Demand;
use App\Helpers\DB\DemandRepository;
use App\Http\Controllers\Controller;
use App\Helpers\Responses\DemandResponse;
use App\Http\Requests\CreateDemandRequest;

class DemandsController extends Controller
{
    public function index()
    {
        # code...
    }

    public function store(CreateDemandRequest $request)
    {
        $demand = DemandRepository::create($request);

        return DemandResponse::store($demand);
    }

    public function show(Demand $demand)
    {
        # code...
    }
}
