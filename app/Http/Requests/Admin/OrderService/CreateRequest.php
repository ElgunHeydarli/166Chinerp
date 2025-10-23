<?php

namespace App\Http\Requests\Admin\OrderService;

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
            'service_id' => ['nullable', 'array'],
            'service_id.*' => ['required', 'integer', 'exists:services,id'],
            'purchase_price' => ['nullable', 'array'],
            'purchase_price.*' => ['nullable', 'numeric', 'min:0'],
            'purchase_currency' => ['nullable', 'array'],
            'purchase_currency.*' => ['required', 'string', 'exists:currencies,symbol'],
            'sale_price' => ['nullable', 'array'],
            'sale_price.*' => ['nullable', 'numeric', 'min:0'],
            'sale_currency' => ['nullable', 'array'],
            'sale_currency.*' => ['required', 'string', 'exists:currencies,symbol'],
            'date' => ['nullable', 'array'],
            'date.*' => ['nullable', 'date'],
            'start_date' => ['nullable', 'array'],
            'start_date.*' => ['nullable', 'date'],
            'end_date' => ['nullable', 'array'],
            'end_date.*' => ['nullable', 'date'],
            'last_payment_date' => ['nullable', 'array'],
            'last_payment_date.*' => ['nullable', 'date'],
            'note' => ['nullable', 'array'],
            'note.*' => ['nullable', 'string'],
            'vendor_id' => ['nullable', 'array'],
            'vendor_id.*' => ['nullable', 'integer', 'exists:vendors,id'],
            'expense_type' => ['nullable', 'array'],
            'expense_type.*' => ['nullable', 'integer', 'exists:expense_types,id'],
            'document_type' => ['nullable', 'array'],
            'document_type.*' => ['nullable', 'string'],
            'order_item_id' => ['required', 'integer', 'exists:order_items,id'],
        ];
    }
}
