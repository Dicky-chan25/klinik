<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrescriptionReq extends FormRequest
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
            'prescript.*.mdc_reg' => 'required',
            'prescript.*.mdc_name' => 'required',
            'prescript.*.mdc_id' => 'required',
            'prescript.*.stock_id' => 'required',
            'prescript.*.qty' => 'required',
            'prescript.*.dose' => 'required',
            'prescript.*.time' => 'required',
            'prescript.*.eating' => 'required',
            'prescript.*.total' => 'required',
        ];
    }
}
