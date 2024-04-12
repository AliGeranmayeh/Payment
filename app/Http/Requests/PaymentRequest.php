<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ValidDemandRule;
use App\Helpers\DB\DemandRepository;

class PaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'demand_ids' => ['required','array','min:1'],
            'demand_ids.*' => ['required','integer' , new ValidDemandRule]
        ];
    }


    protected function passedValidation()
    {
        $demands = DemandRepository::groupFindById($this->demand_ids);
        $this->merge(['demands' => $demands->map(
            fn($demand) => [
                'id' => $demand->id,
                'cost' => $demand->cost,
                'shaba' => $demand->shaba
            ]
        )->toArray()]);
    }
}
