<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ContainerRequest extends FormRequest
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
            'purchase_type' => ['nullable', 'array'],
            'purchase_date' => ['nullable', 'array'],
            'container_type_id' => ['nullable', 'array'],
            'count' => ['nullable', 'array'],
            'price' => ['nullable', 'array'],
            'price_currency' => ['nullable', 'array'],
            'vendor_id' => ['nullable', 'array'],
            'last_payment_date' => ['nullable', 'array'],
            'purchase_type.*' => ['required', 'string', 'in:purchase,rent'],
            'purchase_date.*' => ['required', 'date'],
            'count.*' => ['required', 'integer', 'min:0'],
            'price.*' => ['required', 'numeric', 'min:0.00'],
            'price_currency.*' => ['required', 'string', 'exists:currencies,code'],
            'vendor_id.*' => ['required', 'integer', 'exists:vendors,id'],
            'container_type_id.*' => ['required', 'integer', 'exists:container_types,id'],
            'last_payment_date.*' => ['required', 'date'],
            'images' => ['nullable', 'array'],
            'images.*' => ['nullable', 'file'],
        ];
    }
}
