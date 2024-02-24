<?php

namespace App\Http\Requests\invoice;

use Illuminate\Foundation\Http\FormRequest;

class InvoicesCreate extends FormRequest
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
            'product'               => 'required|string|max:255',
            'invoice_number'        => 'required|string|max:255|unique:invoices,invoice_number',
            'rate_vat'              => 'required|string|max:255',
            'value_vat'             => 'required|numeric',
            'discount'              => 'required|numeric',
            'due_date'              => 'date|nullable',
            'total'                 => 'required|numeric',
            'note'                  => 'nullable|string|max:1000',
            'amount_collection'     => 'nullable|numeric',
            'amount_commission'     => 'required|numeric',
            'section_id'            => 'required|integer',
            'status_id'             => 'required|integer',
            'file'                  => 'nullable|file|mimes:png,jpg,pdf,jpeg',
        ];
    }
}
