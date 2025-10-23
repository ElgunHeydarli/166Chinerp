<?php

namespace App\Http\Requests\Admin\Order;

use Illuminate\Foundation\Http\FormRequest;

class PriceRequest extends FormRequest
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
            'price_type_ids' => ['nullable', 'array'],
            'prices' => ['nullable', 'array'],
            'price_type_ids.*' => ['required', 'integer', 'exists:price_types,id'],
            'prices.*' => ['nullable', 'numeric', 'min:0.00'],
            'currency' => ['nullable', 'array'],
            'currency.*' => ['nullable', 'string', 'exists:currencies,symbol'],
            'total_price' => ['nullable', 'numeric', 'min:0.00'],
            'final_currency' => ['nullable', 'string', 'exists:currencies,symbol'],
        ];
    }
}
