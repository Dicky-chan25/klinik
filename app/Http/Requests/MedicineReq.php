<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MedicineReq extends FormRequest
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
            'code' => 'required',
            'code_mdc' => 'required',
            'mname' => 'required',
            'supplier_id' => 'required',
            'exp_date' => 'required',
            'price' => 'required',
            'qty' => 'required',
            'unit' => 'required',
            'category' => 'required',
        ];
    }
}
