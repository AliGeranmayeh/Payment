<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class NationalCodeMatches implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $userNationalCode = auth()->user()->human->national_code;

        if ($value != $userNationalCode) {
            $fail("The :attribute does not match the authenticated user\'s national code.");
        }
    }

}
