<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class VendorRequest extends FormRequest
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
            'customer_type' => ['required', 'string', 'in:physical,legal'],
            'vendor_name' => ['nullable', 'string', 'max:255'],
            'chinese_name' => ['nullable', 'string', 'max:255'],
            'role' => ['nullable', 'string', 'max:255'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date'],
            'voen' => ['nullable', 'string', 'max:255'],
            'legal_address' => ['nullable', 'string', 'max:255'],
            'factical_address' => ['nullable', 'string', 'max:255'],
            'bank' => ['nullable', 'string', 'max:255'],
            'bank_voen' => ['nullable', 'string', 'max:255'],
            'code' => ['nullable', 'string', 'max:255'],
            'account' => ['nullable', 'string', 'max:255'],
            'agent_account' => ['nullable', 'string', 'max:255'],
            'swift' => ['nullable', 'string', 'max:255'],
            'director' => ['nullable', 'string', 'max:255'],
            'file' => ['nullable', 'file', 'max:10240'],
        ];
    }
}
