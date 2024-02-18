<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MrNurseReq extends FormRequest
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
            'weight' => 'required',
            'height' => 'required',
            'bloodpress' => 'required',
            'bloodpress2' => 'required',
            'heartrate' => 'required',
            'resprate' => 'required',
            'temp' => 'required',
            'sp' => 'required',
            'bloodsugar' => 'required',
            'anamnesis' => 'required',
            'physicalcheck' => 'required',
            'diagnosis' => 'required',
        ];
    }
}
