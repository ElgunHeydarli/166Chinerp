<?php

namespace App\Http\Requests\Admin\Account\UserPayroll;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
{
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $errors = $validator->errors()->all();
        foreach ($errors as $error) {
            toastr($error, 'error');
        }
        return redirect()->back();
    }

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
            'payment_method' => ['required', 'string', 'in:cash,bank'],
            'has_advance' => ['nullable'],
            'advance_payment_method' => ['nullable', 'string', 'in:cash,bank'],
            'advance_price' => ['nullable', 'numeric', 'min:0'],
            'advance_file' => ['nullable', 'array'],
            'advance_file.*' => ['required', 'file'],
        ];
    }
}
