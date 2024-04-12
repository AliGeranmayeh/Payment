<?php



namespace App\Helpers\Responses;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\DemandResource;
use App\Models\Demand;



class DemandResponse

{
    public static function store(Demand|null $demand)
    {
        return $demand ? 
            response()->json(['user' => new DemandResource($demand)], Response::HTTP_OK) :
            response()->json(['message' => 'Failed to record demand'], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
