<?php

namespace App\Http\Requests\Admin\User;

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
            // 'email' => ['required', 'array'],
            // 'password' => ['required', 'array'],
            // 'firstname' => ['required', 'array'],
            // 'lastname' => ['nullable', 'array'],
            // 'fin' => ['nullable', 'array'],
            // 'position' => ['nullable', 'array'],
            // 'mmc' => ['nullable', 'array'],
            // 'phone' => ['nullable', 'array'],
            // 'gender' => ['required', 'array'],
            // 'gross_salary' => ['nullable', 'array'],
            // 'cash' => ['nullable', 'array'],
            // 'bank' => ['nullable', 'array'],
            // 'government_payment' => ['nullable', 'array'],
            // 'net_salary' => ['nullable', 'array'],
            // 'start_date' => ['nullable', 'array'],
            // 'end_date' => ['nullable', 'array'],
            // 'image' => ['nullable', 'array'],
            // 'currency' => ['nullable', 'array'],
            // 'role' => ['nullable', 'array'],
            // 'education_id' => ['nullable', 'array'],
            // 'branch_id' => ['nullable', 'array'],
            // 'country_id' => ['nullable', 'array'],
            // 'status' => ['nullable', 'array'],
            //
            // 'email.*' => ['required', 'string', 'max:255', 'unique:users,email'],
            // 'password.*' => ['required', 'string'],
            // 'firstname.*' => ['required', 'string', 'max:255'],
            // 'lastname.*' => ['nullable', 'string', 'max:255'],
            // 'fin.*' => ['nullable', 'string', 'max:255'],
            // 'position.*' => ['nullable', 'string', 'max:255'],
            // 'mmc.*' => ['nullable', 'string', 'max:255'],
            // 'phone.*' => ['nullable', 'string', 'max:255'],
            // 'gender.*' => ['required', 'string', 'in:male,female'],
            // 'gross_salary.*' => ['nullable', 'numeric', 'min:0'],
            // 'cash.*' => ['nullable', 'numeric', 'min:0'],
            // 'bank.*' => ['nullable', 'numeric', 'min:0'],
            // 'government_payment.*' => ['nullable', 'numeric', 'min:0'],
            // 'net_salary.*' => ['nullable', 'numeric', 'min:0'],
            // 'start_date.*' => ['nullable', 'date'],
            // 'end_date.*' => ['nullable', 'date'],
            // 'status.*' => ['required', 'integer', 'in:0,1'],
            // 'image.*' => ['nullable', 'image', 'max:10240'],
            // 'currency.*' => ['nullable', 'string', 'exists:currencies,code'],
            // 'role.*' => ['nullable', 'string', 'exists:roles,name'],
            // 'education_id.*' => ['nullable', 'integer', 'exists:education,id'],
            // 'branch_id.*' => ['nullable', 'integer', 'exists:branches,id'],
            // 'country_id.*' => ['nullable', 'integer', 'exists:countries,id'],
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required','string', 'min:6'],
            'role' => ['nullable', 'string', 'exists:roles,name'],
        ];
    }
}
