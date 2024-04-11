<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Human extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'national_code'
    ];
}
