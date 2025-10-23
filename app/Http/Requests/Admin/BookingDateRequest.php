<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BookingDateRequest extends FormRequest
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
            'date' => ['required', 'date'],
            'last_payment_date' => ['required', 'date'],
            'count' => ['required', 'integer', 'min:0'],
            'vendor_id' => ['required', 'integer', 'exists:vendors,id'],
            'station_id' => ['required', 'integer', 'exists:stations,id'],
            'container_type_id' => ['required', 'integer', 'exists:container_types,id'],
        ];
    }
}
