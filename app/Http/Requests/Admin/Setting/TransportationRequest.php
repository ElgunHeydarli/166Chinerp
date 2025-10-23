<?php

namespace App\Http\Requests\Admin\Setting;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TransportationRequest extends FormRequest
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
            'name'=>[
                'required',
                'string',
                'max:255',
                Rule::unique('transportations','name')
                    ->where('transportation_service_id',$this->transportation_service_id)
                    ->ignore($this->route('transportation')),
            ],
            'status'=>['required','integer','in:0,1'],
            'transportation_service_id'=>['required','integer','exists:transportation_services,id'],
        ];
    }
}
