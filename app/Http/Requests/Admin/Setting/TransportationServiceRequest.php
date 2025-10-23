<?php

namespace App\Http\Requests\Admin\Setting;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TransportationServiceRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('transportation_services', 'name')
                    ->where('transportation_type_id', $this->transportation_type_id)
                    ->ignore($this->route('transportation-type')),
            ],
            'status' => ['required', 'integer', 'in:0,1'],
            'transportation_type_id' => ['required', 'integer', 'exists:transportation_types,id'],
        ];
    }
}
