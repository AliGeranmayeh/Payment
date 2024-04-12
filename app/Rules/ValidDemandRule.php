<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\Demand;
use App\Enums\DemandStatusEnum;

class ValidDemandRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        try {
            Demand::query()->whereId($value)->whereStatus(DemandStatusEnum::ACCEPTED)->firstOrFail();
        }
        catch (\Throwable $th) {
            $fail('Invalid demand for payment.');
        }
    }
}
