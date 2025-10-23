<?php

namespace App\Http\Requests\Admin\Account\Salary;

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
            'email' => ['required', 'string', 'max:255'],
            'password' => ['nullable', 'string'],
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['nullable', 'string', 'max:255'],
            'fin' => ['nullable', 'string', 'max:255'],
            'position' => ['nullable', 'string', 'max:255'],
            'mmc' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:255'],
            'gender' => ['required', 'string', 'in:male,female'],
            'gross_salary' => ['nullable', 'numeric', 'min:0'],
            'cash' => ['nullable', 'numeric', 'min:0'],
            'bank' => ['nullable', 'numeric', 'min:0'],
            'government_payment' => ['nullable', 'numeric', 'min:0'],
            'net_salary' => ['nullable', 'numeric', 'min:0'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date'],
            'image' => ['nullable', 'image', 'max:10240'],
            'currency' => ['nullable', 'string', 'exists:currencies,code'],
            'status' => ['required', 'integer', 'in:0,1'],
            'role' => ['nullable', 'string', 'exists:roles,name'],
            'education_id' => ['nullable', 'integer', 'exists:education,id'],
            'branch_id' => ['nullable', 'integer', 'exists:branches,id'],
            'country_id' => ['nullable', 'integer', 'exists:countries,id'],
        ];
    }
}
