<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StepTwoRequest extends FormRequest
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
            'company_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'website' => 'required|url',
            'company_zipcode' => 'required',
        ];
    }
}
