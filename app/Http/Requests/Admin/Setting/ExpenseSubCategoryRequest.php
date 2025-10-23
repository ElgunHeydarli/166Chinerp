<?php

namespace App\Http\Requests\Admin\Setting;

use Illuminate\Foundation\Http\FormRequest;

class ExpenseSubCategoryRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255', 'unique:expense_sub_categories,name,' . $this->route('expense_sub_category')],
            'expense_category_id' => ['required', 'integer', 'exists:expense_categories,id'],
            'status' => ['required', 'integer', 'in:0,1'],
        ];
    }
}
