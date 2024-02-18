<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MedicineInReq extends FormRequest
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
            'medicine' => 'required',
            'noreg' => 'required',
            'nobatch' => 'required',
            'pdate' => 'required',
            'shape' => 'required',
            'expdate' => 'required',
            'price' => 'required',
            'het' => 'required',
            'category' => 'required',
            'unit' => 'required',
            'weight' => 'required',
            'qty' => 'required',
            'inputs.*.age' => 'required',
            'inputs.*.dosemin' => 'required',
            'inputs.*.dosemax' => 'required',
            'inputs.*.eating' => 'required',
        ];
    }
}
