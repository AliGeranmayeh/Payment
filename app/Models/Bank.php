<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Bank extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'identifier'
    ];


    public function customers(): BelongsToMany
    {
        return $this->belongsToMany(Human::class,'bank_accounts');
    }
}
