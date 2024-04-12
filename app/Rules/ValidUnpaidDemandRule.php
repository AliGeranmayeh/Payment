<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\Demand;
use App\Enums\DemandStatusEnum;

class ValidUnpaidDemandRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        try {
            Demand::query()->where('id',$value)->whereNot('status' , DemandStatusEnum::PAID)->firstOrFail();
        }
        catch (\Throwable $th) {
            $fail('Invalid demand for payment.');
        }
    }
}
