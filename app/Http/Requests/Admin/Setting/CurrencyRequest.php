<?php

namespace App\Http\Requests\Admin\Setting;

use Illuminate\Foundation\Http\FormRequest;

class CurrencyRequest extends FormRequest
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
            'name' => ['required', 'string', 'unique:currencies,name,' . $this->route('currency')],
            'code' => ['required', 'string', 'unique:currencies,code,' . $this->route('currency')],
            'symbol' => ['required', 'string', 'unique:currencies,symbol,' . $this->route('currency')],
        ];
    }
}
