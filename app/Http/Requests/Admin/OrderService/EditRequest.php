<?php

namespace App\Http\Requests\Admin\OrderService;

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
            'service_id' => ['required', 'integer', 'exists:services,id'],
            'purchase_price' => ['nullable', 'numeric', 'min:0'],
            'sale_price' => ['nullable', 'numeric', 'min:0'],
            'date' => ['nullable', 'date'],
            'start_date' => ['nullable', 'date'],
            'last_payment_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date'],
            'note' => ['nullable', 'string'],
            'vendor_id' => ['nullable', 'integer', 'exists:vendors,id'],
            'expense_type_id' => ['nullable', 'integer', 'exists:expense_types,id'],
            'document_type' => ['nullable', 'string', 'max:255'],
            'purchase_currency' => ['required', 'string', 'exists:currencies,symbol'],
            'sale_currency' => ['required', 'string', 'exists:currencies,symbol'],
        ];
    }
}
