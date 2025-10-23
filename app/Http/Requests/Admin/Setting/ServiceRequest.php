<?php

namespace App\Http\Requests\Admin\Setting;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255', 'unique:services,name,' . $this->route('service')],
            'status' => ['required', 'integer', 'in:0,1'],
            'detail_name' => ['nullable', 'array'],
            'detail_name.*' => ['required', 'string', 'in:expense_type,document_type,start_date,end_date,note'],
        ];
    }
}
