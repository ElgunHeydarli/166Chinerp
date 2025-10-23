<?php

namespace App\Http\Requests\Admin\Account\Receive;

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
            'invoice_id' => ['required', 'string', 'unique:receives,invoice_id'],
            'service_name' => ['required', 'string', 'max:255'],
            'invoice_date' => ['required', 'date'],
            'last_payment_date' => ['required', 'date'],
            'currency' => ['required', 'string', 'exists:currencies,code'],
            'price' => ['required', 'numeric', 'min:0'],
            'vat' => ['nullable', 'numeric', 'min:0'],
            'total_price' => ['nullable', 'numeric', 'min:0'],
            'initial_payment' => ['nullable', 'numeric', 'min:0'],
            'remainder' => ['nullable', 'numeric'],
            'status' => ['required', 'string', 'in:pending,paid,not_paid'],
            'order_id' => ['nullable', 'integer', 'exists:orders,id'],
            'country_id' => ['required', 'integer', 'exists:countries,id'],
            'customer_id' => ['required', 'integer', 'exists:customers,id'],
        ];
    }
}
