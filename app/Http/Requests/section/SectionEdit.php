<?php

namespace App\Http\Requests\section;

use Illuminate\Foundation\Http\FormRequest;

class SectionEdit extends FormRequest
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
            'section_name' => 'required|string|max:255',
            'desc' => ['nullable', 'max:1000','string'],
        ];
    }
    public function attributes(){
        return[
            'section_name' => __('Section Name'),
            'desc' => __('Section Name'),
            ];
    }
}
