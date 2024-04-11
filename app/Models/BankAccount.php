<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'credit',
        'human_id',
        'bank_id',
        'shaba',
        'number',
        'password'
    ];

    protected $casts = [
        'password' => 'hashed',
    ];
}
