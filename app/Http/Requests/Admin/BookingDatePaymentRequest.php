<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BookingDatePaymentRequest extends FormRequest
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
            'entry_to_warehouse_date' => ['required', 'date'],
            'price' => ['required', 'numeric', 'min:0'],
            'currency' => ['required', 'string', 'exists:currencies,symbol'],
            'file' => ['nullable', 'file', 'mimes:png,jpg,xlsx,pdf', 'max:10240'],
        ];
    }
}
