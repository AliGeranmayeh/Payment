<?php

namespace App\Http\Controllers\AdminSide;

use App\Http\Controllers\Controller;
use App\Models\Demand;
use App\Helpers\DB\DemandRepository;
use App\Helpers\Responses\DemandResponse;
use App\Http\Requests\ChangeDemandStatusRequest;
use App\Enums\DemandStatusEnum;
use App\Events\DeclinedStatusEvent;

class DemandController extends Controller
{
    public function index()
    {
        $demands = DemandRepository::all();

        return DemandResponse::index($demands);
    }

    public function show(Demand $demand)
    {
        return DemandResponse::show($demand);
    }

    public function changeStatus(Demand $demand, ChangeDemandStatusRequest $request)
    {
        $isUpdated = DemandRepository::update($demand, $request->validated());
        $this->dispatchEvent($demand,$request->status);

        return DemandResponse::changeStatus($isUpdated);
    }


    private function dispatchEvent(Demand $demand,$status)
    {
        if ($status == DemandStatusEnum::DECLINED->value) {
            DeclinedStatusEvent::dispatch($demand);
        } 
    }
}
