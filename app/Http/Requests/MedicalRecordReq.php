<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MedicalRecordReq extends FormRequest
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
            'patient' => 'required',
            'service' => 'required',
            'poli' => 'required',
            // 'doctor' => 'required',
            // 'blood' => 'required',
            // 'weight' => 'required|max:3',
            // 'height' => 'required|max:3',
            // 'waist' => 'required|max:3',
            // 'complain' => 'required',
            // 'diagnose' => 'required',
            // 'action' => 'required',
        ];
    }
}
