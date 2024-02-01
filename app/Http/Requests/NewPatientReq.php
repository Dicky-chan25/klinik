<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewPatientReq extends FormRequest
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
            'fullname' => 'required',
            'identity' => 'required|unique:c_patient',
            'birthplace' => 'required',
            'birthdate' => 'required',
            'gender' => 'required',
            'religion' => 'required',
            'education' => 'required',
            'career' => 'required',
            'wa' => 'required|min:11',
            'address' => 'required',
            'service' => 'required',
            'complain' => 'required',

        ];
    }
}
