<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Demand;
use App\Enums\DemandStatusEnum;

class DemandResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'description' => $this->description,
            'cost' => $this->cost,
            'shaba' => $this->shaba,
            'file' => $this->file,
            'status' => $this->status ?? DemandStatusEnum::PENDING,
            'category' => $this->category->name
        ];
    }
}
