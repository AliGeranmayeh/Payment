<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\DemandStatusEnum;

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
}
