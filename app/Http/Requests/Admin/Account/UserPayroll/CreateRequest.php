<?php

namespace App\Http\Requests\Admin\Account\UserPayroll;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            'cash_value' => ['nullable', 'array'],
            'bank_value' => ['nullable', 'array'],
            'government_value' => ['nullable', 'array'],
            'withholding_value' => ['nullable', 'array'],
            'bonus_value' => ['nullable', 'array'],
            'bank_file' => ['nullable', 'file'],
            'cash_file' => ['nullable', 'file'],
            'last_payment_date' => ['nullable', 'date'],
            'currency' => ['nullable', 'string', 'exists:currencies,code'],
        ];
    }
}
