<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class DraftRequest extends FormRequest
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
            'factory_name' => ['nullable', 'string', 'max:255'],
            'factory_phone' => ['nullable', 'string', 'max:255'],
            'cube' => ['nullable', 'string', 'max:255'],
            'weight' => ['nullable', 'required_if:mix_full,mix,full', 'string', 'max:255'],
            'apply_date' => ['nullable', 'date'],
            'referrer' => ['nullable', 'string', 'max:255'],
            'loading_point' => ['required', 'string', 'max:255'],
            'security_mode' => ['nullable', 'integer', 'in:0,1'],
            'mix_full' => ['required', 'string', 'in:mix,full,automobile'],
            'cbm' => ['nullable', 'numeric', 'min:0'],
            'price' => ['nullable', 'numeric', 'min:0'],
            'price_currency'=>['nullable','string','exists:currencies,symbol'],
            'is_evaluate' => ['nullable', 'integer', 'in:0,1'],
            'stackable' => ['nullable', 'integer', 'in:0,1'],
            'exportable' => ['nullable', 'integer', 'in:0,1'],
            'number_of_places' => ['nullable', 'string', 'max:255'],
            'width' => ['nullable', 'numeric', 'min:0'],
            'height' => ['nullable', 'numeric', 'min:0'],
            'length' => ['nullable', 'numeric', 'min:0'],
            'first_car_count' => ['nullable', 'integer', 'min:0'],
            'second_car_count' => ['nullable', 'integer', 'min:0'],
            'product_name' => ['nullable', 'string', 'max:255'],
            'msds' => ['nullable', 'string', 'max:255'],
            'note' => ['nullable', 'string'],
            'user_id' => ['nullable', 'integer', 'exists:users,id'],
            'customs_clearance_id' => ['required', 'integer', 'exists:customs_clearances,id'],
            'container_type_id' => ['nullable', 'required_if:mix_full,full', 'integer', 'exists:container_types,id'],
            'container_count' => ['nullable', 'required_if:mix_full,full', 'integer', 'min:1', 'max:50'],
            'incoterm_id' => ['required', 'integer', 'exists:incoterms,id'],
            'customer_id' => ['required', 'integer', 'exists:customers,id'],
            'warehouse_id' => ['nullable', 'integer', 'exists:warehouses,id'],
            'first_car_type_id' => ['nullable', 'required_if:mix_full,automobile', 'integer', 'exists:car_types,id'],
            'second_car_type_id' => ['nullable', 'integer', 'exists:car_types,id'],
            'file' => ['nullable', 'file'],
        ];
    }
}
