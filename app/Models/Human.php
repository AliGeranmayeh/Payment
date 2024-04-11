<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Human extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'national_code'
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function bankAccounts(): BelongsToMany
    {
        return $this->belongsToMany(Bank::class,'bank_accounts');
    }
}
