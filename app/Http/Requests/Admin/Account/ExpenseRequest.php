<?php

namespace App\Http\Requests\Admin\Account;

use Illuminate\Foundation\Http\FormRequest;

class ExpenseRequest extends FormRequest
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
            'log_id' => ['nullable', 'string'],
            'total_price' => ['nullable', 'numeric', 'min:0'],
            'pay_price' => ['nullable', 'numeric', 'min:0'],
            'remainder' => ['nullable', 'numeric', 'min:0'],
            'last_payment_date' => ['nullable', 'date'],
            'currency' => ['nullable', 'string', 'exists:currencies,code'],
            'expense_type' => ['nullable', 'string', 'in:one-time,recurring'],
            'factory' => ['nullable', 'string', 'max:255'],
            'note' => ['nullable', 'string'],
            'expense_category_id' => ['required', 'integer', 'exists:expense_categories,id'],
            'expense_sub_category_id' => ['required', 'integer', 'exists:expense_sub_categories,id'],
        ];
    }
}
