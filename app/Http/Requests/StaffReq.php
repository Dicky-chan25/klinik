<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StaffReq extends FormRequest
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
            'name' => 'required',
            'role' => 'required',
            'email' => 'required',
            'address' => 'required',
            'birthdate' => 'required',
            'birthplace' => 'required',
            'identity' => 'required',
            'phone' => 'required',
            'gender' => 'required',
        ];
    }
}