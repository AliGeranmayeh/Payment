<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reply extends Model
{
    use HasFactory;

    protected $fillable = [
        'text',
        'demand_id'
    ];

    public function demand(): BelongsTo
    {
        return $this->belongsTo(Demand::class);
    }

}
