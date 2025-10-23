<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            // order details start
            'customer_id' => ['nullable', 'integer', 'exists:customers,id'],
            'transportation_type_id' => ['nullable', 'integer', 'exists:transportation_types,id'],
            'transportation_service_id' => ['nullable', 'integer', 'exists:transportation_services,id'],
            'transportation_id' => ['nullable', 'integer', 'exists:transportations,id'],
            'price' => ['nullable', 'numeric', 'min:0'],
            'price_currency' => ['nullable', 'string', 'exists:currencies,symbol'],
            'user_id' => ['nullable', 'integer', 'exists:users,id'],
            'voen_fin' => ['nullable', 'string'],
            'delivery_date' => ['nullable', 'date'],
            'tax_id' => ['nullable', 'string', 'max:255'],
            'supplier_address' => ['nullable', 'string', 'max:255'],
            'internal_transport' => ['nullable', 'in:0,1'],
            'security_mode' => ['nullable', 'in:0,1'],
            'exportable' => ['nullable', 'in:0,1'],
            'address' => ['nullable', 'string', 'max:255'],
            'district_id' => ['nullable', 'integer', 'exists:districts,id'],
            'city_id' => ['nullable', 'integer', 'exists:cities,id'],
            'ready_status' => ['nullable', 'in:0,1'],
            'warehouse_id' => ['nullable', 'integer', 'exists:warehouses,id'],
            'apply_date' => ['nullable', 'date'],
            'mix_full' => ['nullable', 'string', 'in:mix,full,automobile'],
            'referrer' => ['nullable', 'string', 'max:255'],
            'customs_clearance_id' => ['nullable', 'integer', 'exists:customs_clearances,id'],
            'about_booking_date' => ['nullable', 'date'],
            'container_type_id' => ['nullable', 'integer', 'exists:container_types,id'],
            'container_count' => ['nullable', 'integer', 'min:1', 'max:50'],
            'incoterm_id' => ['nullable', 'integer', 'exists:incoterms,id'],
            'loading_point' => ['nullable', 'string', 'max:255'],
            'width' => ['nullable', 'array'],
            'height' => ['nullable', 'array'],
            'length' => ['nullable', 'array'],
            'car_count' => ['nullable', 'array'],
            'width.*' => ['nullable', 'numeric', 'min:0'],
            'height.*' => ['nullable', 'numeric', 'min:0'],
            'length.*' => ['nullable', 'numeric', 'min:0'],
            'car_count.*' => ['nullable', 'integer', 'min:0'],
            'number_of_places' => ['nullable', 'numeric', 'min:0'],
            'first_car_count' => ['nullable', 'integer', 'min:0'],
            'second_car_count' => ['nullable', 'integer', 'min:0'],
            // order details end

            // factory files start
            'is_customer_upload' => ['nullable', 'array'],
            'contract' => ['nullable', 'array'],
            'contract_file' => ['nullable', 'array'],
            'invoice' => ['nullable', 'array'],
            'invoice_file' => ['nullable', 'array'],
            'packing_list' => ['nullable', 'array'],
            'packing_list_file' => ['nullable', 'array'],
            'is_customer_upload.*' => ['nullable'],
            'contract.*' => ['nullable', 'file'],
            'invoice.*' => ['nullable', 'file'],
            'packing_list.*' => ['nullable', 'file'],
            'contract_file.*' => ['nullable', 'string'],
            'invoice_file.*' => ['nullable', 'string'],
            'packing_list_file.*' => ['nullable', 'string'],
            // factory files end

            // factory details start
            'factory_name' => ['nullable', 'array'],
            'factory_phone' => ['nullable', 'array'],
            'factory_cube' => ['nullable', 'array'],
            'factory_delivery_point' => ['nullable', 'array'],
            'box_count' => ['nullable', 'array'],
            'palette_count' => ['nullable', 'array'],
            'product_type_id' => ['nullable', 'array'],
            'factory_note' => ['nullable', 'array'],
            'factory_name.*' => ['nullable', 'string', 'max:255'],
            'factory_phone.*' => ['nullable', 'string', 'max:255'],
            'factory_cube.*' => ['nullable', 'string', 'max:255'],
            'factory_delivery_point.*' => ['nullable', 'string', 'max:255'],
            'box_count.*' => ['nullable', 'integer', 'min:0'],
            'palette_count.*' => ['nullable', 'integer', 'min:0'],
            'product_type_id.*' => ['nullable', 'integer', 'exists:product_types,id'],
            'factory_note.*' => ['nullable', 'string'],
            // factory details end

            // factory products start
            'products' => ['nullable', 'array'],
            'products.*' => ['nullable', 'array'],
            'products.*.*' => ['nullable', 'string', 'max:255'],
            // factory products end

            // payment details start
            'payment_type_id' => ['nullable', 'integer', 'exists:payment_types,id'],
            'percent' => ['nullable', 'numeric', 'min:0'],
            'remainder' => ['nullable', 'numeric', 'min:0'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date'],
            'payment_note' => ['nullable', 'string'],
            // payment details end

            // factory vin codes start
            'vin_codes' => ['nullable', 'array'],
            'vin_codes.*' => ['nullable', 'array'],
            'vin_codes.*.*' => ['nullable', 'string', 'max:255'],
            // factory vin codes end
        ];
    }
}
