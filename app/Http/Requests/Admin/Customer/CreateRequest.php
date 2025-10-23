<?php

namespace App\Http\Requests\Admin\Customer;

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
            'name' => ['nullable', 'string', 'max:255'],
            'gender' => ['nullable', 'string', 'in:male,female'],
            'fin' => ['nullable', 'string', 'max:255'],
            'serial_number' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'source_id' => ['nullable', 'integer', 'exists:sources,id'],
            'contract_number' => ['nullable', 'string', 'max:255'],
            'contract_start_date' => ['nullable', 'date'],
            'contract_end_date' => ['nullable', 'date'],
            'user_id' => ['nullable', 'integer', 'exists:users,id'],
            'payment_term_id' => ['nullable', 'integer', 'exists:payment_terms,id'],
            'date' => ['nullable', 'date'],
            'type' => ['required', 'string', 'in:physical,legal,owner'],
            'contract' => ['nullable', 'file'],
            'bill_invoice' => ['nullable', 'file'],
            'handover' => ['nullable', 'file'],
            'price_agreement_protocol' => ['nullable', 'file'],
            'note' => ['nullable', 'string'],
            'files' => ['nullable', 'array'],
            'files.*' => ['nullable', 'file'],
            // if customer type is not physical
            'voen' => ['nullable', 'string', 'max:255'],
            'legal_address' => ['nullable', 'string', 'max:255'],
            'factical_address' => ['nullable', 'string', 'max:255'],
            'bank_voen' => ['nullable', 'string', 'max:255'],
            'bank_name' => ['nullable', 'string', 'max:255'],
            'code' => ['nullable', 'string', 'max:255'],
            'account' => ['nullable', 'string', 'max:255'],
            'agent_account' => ['nullable', 'string', 'max:255'],
            'swift' => ['nullable', 'string', 'max:255'],
            'director' => ['nullable', 'string', 'max:255'],
            'sector_id' => ['nullable', 'integer', 'exists:sectors,id'],
            'person_name' => ['nullable', 'array'],
            'person_phone' => ['nullable', 'array'],
            'person_name.*' => ['required', 'string', 'max:255'],
            'person_phone.*' => ['required', 'string', 'max:255'],
        ];
    }
}
