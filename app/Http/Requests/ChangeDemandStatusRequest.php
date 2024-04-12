<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\DemandStatusEnum;

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
            'status' => ['required', 'string', 'in:' .$this->statusAllowedValues()]
        ];
    }

    private function statusAllowedValues()
    {
        return implode(',', [DemandStatusEnum::DECLINED->value, DemandStatusEnum::ACCEPTED->value]);
    }
}
