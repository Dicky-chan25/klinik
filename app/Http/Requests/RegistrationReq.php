<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationReq extends FormRequest
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
            'queue_no' => 'required',
            'rm_code' => 'required',
            'alergy' => 'required',
            'reg_code' => 'required',
            'ass_code' => 'required',
            'onr_code' => 'required',
            'or_code' => 'required',
            'act_code' => 'required',
            'lab_code' => 'required',
            'doctor_id' => 'required',
            'patient_id' => 'required',
            'payment_method' => 'required',
            'entry_method' => 'required',
            'nursing_status' => 'required',
            'payment_status' => 'required',
            'admin_action' => 'required',
        ];
    }
}
