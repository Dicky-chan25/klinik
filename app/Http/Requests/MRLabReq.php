<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MRLabReq extends FormRequest
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
            'reffering_dr' => 'required',
            'diagnosis' => 'required',
            'info' => 'required',
            'lab_dr' => 'required',
            'checked_date' => 'required',
            'lab.*' => 'required',
        ];
    }
}
