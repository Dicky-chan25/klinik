<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|unique:users',
            'pwd' => 'required|min:6',
            'rpwd' => 'required|min:6',
        ];
    }
    public function messages()
    {
        return [
            'fname.required' => 'Nama Depan Belum Diisi !!!',
            'lname.required' => 'Nama Belakang Belum Diisi !!!',
            'email.required' => 'Email Belum Diisi !!!',
            'pwd.required' => 'Password Belum Diisi !!!',
            'rpwd.required' => 'Ulangi Password Belum Diisi !!!',
        ];
    }
}
