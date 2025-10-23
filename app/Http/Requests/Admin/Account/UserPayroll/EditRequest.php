<?php

namespace App\Http\Requests\Admin\Account\UserPayroll;

use Illuminate\Foundation\Http\FormRequest;

class EditRequest extends FormRequest
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
            'cash_payment' => ['nullable', 'numeric', 'min:0'],
            'bank_payment' => ['nullable', 'numeric', 'min:0'],
            'government_payment' => ['nullable', 'numeric', 'min:0'],
            'withholding_payment' => ['nullable', 'numeric', 'min:0'],
            'bonus' => ['nullable', 'numeric', 'min:0'],
            'currency' => ['nullable', 'string', 'exists:currencies,code'],
            'bank_file' => ['nullable', 'file'],
            'cash_file' => ['nullable', 'file'],
            'year' => ['nullable', 'integer'],
            'month' => ['nullable', 'string', 'in:january,february,march,april,may,june,july,august,september,october,novemver,december'],
        ];
    }
}
