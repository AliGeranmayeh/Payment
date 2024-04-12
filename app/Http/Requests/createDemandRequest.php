<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\NationalCodeMatches;
use Illuminate\Support\Str;

class createDemandRequest extends FormRequest
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
            'description' => ['required', 'string', 'min:5'],
            'cost' => ['required', 'integer', 'min:1'],
            'shaba' => ['required', 'string', 'exists:bank_accounts,shaba'],
            'file' => ['required', 'file', 'mimes:jpeg,png,gif,pdf'],
            'national_code' => ['required', 'string', 'exists:humans,national_code', new NationalCodeMatches],
            'category_id' => ['required', 'integer', 'exists:categories,id']
        ];
    }

    public function passedValidation()
    {
        $this->merge(['user_id' => auth()->user()->id]);

        $filePath = $this->storeUploadedFile($this->file('file'));
        $this->merge(['file' => $filePath]);
    }

    private function storeUploadedFile($file)
    {
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $fileName = $this->createFileName($originalName, $extension);
        $filePath = 'files/demands/' . auth()->user()->id;

        return $file->storeAs($filePath, $fileName);
    }

    private function createFileName($name, $extension)
    {
        return sprintf(
            '%s_%s.%s',
            now()->format('Y-m-d_H-i-s'),
            Str::slug($name),
            $extension
        );
    }
}
