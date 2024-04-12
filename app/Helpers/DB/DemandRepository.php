<?php


namespace App\Helpers\DB;
use App\Models\Demand;
use Illuminate\Support\Facades\Storage;


class DemandRepository

{
    public static function create($data)
    {
        try {
            return Demand::create([
                'description' => $data->description,
                'cost' => $data->cost,
                'shaba' => $data->shaba,
                'file' => $data->file_path,
                'user_id' => $data->user_id,
                'category_id' => $data->category_id
            ]);
        }
        catch (\Throwable $th) {
            Storage::delete($data->file_path);
            return null;
        }

    }

    public static function all(bool $isAdmin = false)
    {
        return Demand::query()->when(!$isAdmin,
            fn($query) => $query->userDemand())
            ->orderByDesc('created_at')
            ->get();
    }
}
