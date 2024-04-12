<?php

namespace App\Http\Controllers\AdminSide;

use App\Http\Controllers\Controller;
use App\Models\Demand;
use App\Helpers\DB\DemandRepository;
use App\Helpers\Responses\DemandResponse;

class DemandController extends Controller
{
    public function index()
    {
        $demands = DemandRepository::all();

        return DemandResponse::index($demands);
    }

    public function show(Demand $demand)
    {
        # code...
    }

    public function changeStatus(Demand $demand)
    {
        # code...
    }
}
