<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class OrderExpenseRequest extends FormRequest
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
            'price'               => ['nullable', 'array'],
            'expense_type_id'     => ['nullable', 'array'],
            'payment_type_id'     => ['nullable', 'array'],
            'vendor_id'           => ['nullable', 'array'],
            'note'                => ['nullable', 'array'],
            'account_id'          => ['nullable', 'integer', 'exists:ledger_accounts,id'], // ✅ düzəldildi

            // Nested validation
            'price.*'             => ['required', 'numeric', 'min:0.00'],
            'expense_type_id.*'   => ['required', 'integer', 'exists:expense_types,id'],
            'vendor_id.*'         => ['required', 'integer', 'exists:vendors,id'],
            'payment_type_id.*'   => ['required', 'integer', 'exists:payment_types,id'],
            'note.*'              => ['nullable', 'string'],
        ];
    }
}
