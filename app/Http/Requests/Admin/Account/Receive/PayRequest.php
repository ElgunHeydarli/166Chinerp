<?php

namespace App\Http\Requests\Admin\Account\Receive;

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
            'currency' => ['required', 'string', 'exists:currencies,symbol'],
            'price' => ['required', 'numeric', 'min:0'],
            'file' => ['nullable', 'file'],
            'note' => ['nullable', 'string'],
            'payment_method' => ['required', 'string', 'in:bank,cash'],
        ];
    }
}
