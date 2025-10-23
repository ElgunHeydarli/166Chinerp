<?php

namespace App\Http\Requests\Admin\Account\Expense;

use Illuminate\Foundation\Http\FormRequest;

class PayRequest extends FormRequest
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
            'date' => ['required', 'date'],
            'amount' => ['required', 'numeric', 'min:0'],
            'currency' => ['required', 'string', 'exists:currencies,code'],
            'payment_method' => ['required', 'string', 'in:cash,bank'],
            'file' => ['nullable', 'file'],
        ];
    }
}
