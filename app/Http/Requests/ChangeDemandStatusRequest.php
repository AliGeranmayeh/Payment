<?php

namespace App\Http\Requests;

use App\Enums\DemandStatusEnum;
use App\Helpers\DB\DemandRepository;
use App\Rules\ValidUnpaidDemandRule;
use Illuminate\Foundation\Http\FormRequest;

class ChangeDemandStatusRequest extends FormRequest
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
            'demand_ids.*' => ['required','integer', new ValidUnpaidDemandRule],
            'status' => ['required', 'string', 'in:' .$this->statusAllowedValues()]
        ];
    }

    protected function passedValidation()
    {
        $demands = DemandRepository::groupFindById($this->demand_ids);
        $this->merge(['demands' => $demands]);
    }

    private function statusAllowedValues()
    {
        return implode(',', [DemandStatusEnum::DECLINED->value, DemandStatusEnum::ACCEPTED->value]);
    }
}
