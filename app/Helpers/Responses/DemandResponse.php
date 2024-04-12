<?php



namespace App\Helpers\Responses;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\DemandResource;
use App\Models\Demand;
use App\Helpers\Responses\Interfaces\DemandResponseInterface;



class DemandResponse implements DemandResponseInterface
{

    public static function index($demands)
    {
        return response()->json(['demands' => DemandResource::collection($demands)], Response::HTTP_OK);
    }

    public static function store(Demand|null $demand)
    {
        return $demand ? 
            response()->json(['demand' => new DemandResource($demand)], Response::HTTP_OK) :
            response()->json(['message' => 'Failed to record demand'], Response::HTTP_INTERNAL_SERVER_ERROR);
    }


    public static function show(Demand $demands)
    {
        return response()->json(['demands' => new DemandResource($demands)], Response::HTTP_OK);
    }

    public static function changeStatus()
    {
        return response()->json(['message' => 'demand status updated successfully'], Response::HTTP_OK);
    }


    public static function download(string $filePath)
    {
        return response()->download($filePath);
    }
}
