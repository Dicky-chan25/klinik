<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoctorReq extends FormRequest
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
            // 'staff_id' => 'required',
            // 'sip' => 'required',
            // 'str' => 'required',
            // 'specialize' => 'required',
            // 'price' => 'required',
            // 'info' => 'required',
            // 'user_id' => 'required',
            // 'pic' => 'required|image|mimes:png,jpg,jpeg,svg|max:2048',
            'staff_id' => 'required|unique:c_doctor',
            'sip' => 'required|unique:c_doctor',
            'str' => 'required|unique:c_doctor',
            'specialize' => 'required',
            'price' => 'required',
            'info' => 'required',
            'user_id' => 'required|unique:c_doctor',
            'pic' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        ];
    }
}
