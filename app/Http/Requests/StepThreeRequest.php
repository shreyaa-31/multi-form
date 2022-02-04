<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StepThreeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'identification_doc' => 'required',
            'identification_doc.*' => 'mimes:jpg,jpeg,png',
            'criminal_doc.*' => 'mimes:jpg,jpeg,png',
            'medical_doc.*' => 'mimes:jpg,jpeg,png',
            'education_doc' => 'required',
            'education_doc.*' => 'mimes:jpg,jpeg,png',
        ];
    }
    public function attributes()
    {
        return[
            'identification_doc.*' => "Id proof",
            'criminal_doc.*' => "Criminal Document",
            'medical_doc.*' => "Medical Document",
            'education_doc.*' => "Educational Document",
        ];
    }
}
