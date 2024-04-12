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

    public function changeStatus(ChangeDemandStatusRequest $request)
    {
        $this->updateDemandStatus($request->demands, $request->validated());

        return DemandResponse::changeStatus();
    }


    public function download(Demand $demand)
    {
        DemandResponse::download(storage_path('app/'.$demand->file));
    }



    private function updateDemandStatus($demands, array $data)
    {
        $demands->map(function($demand) use($data){
            DemandRepository::update($demand, $data);
            $this->dispatchEvent($demand,$data['status']);
        });
    }

    private function dispatchEvent(Demand $demand,$status)
    {
        if ($status == DemandStatusEnum::DECLINED->value) {
            DeclinedStatusEvent::dispatch($demand);
        } 
    }
}
