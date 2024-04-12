<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\DemandStatusEnum;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Demand extends Model
{
    use HasFactory;


    protected $fillable = [
        'description',
        'cost',
        'shaba',
        'file',
        'status',
        'user_id',
        'category_id'
    ];

    protected $casts = [
        'status' => DemandStatusEnum::class,
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeUserDemand($query)
    {
        return $query->where('user_id',auth()->user()->id);
    }
}
