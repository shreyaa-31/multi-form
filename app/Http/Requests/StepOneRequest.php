<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StepOneRequest extends FormRequest
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
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'mobile' => 'required|string|numeric|digits:10|unique:users',
            'password' => 'required|string|min:8',
            'date_of_birth' => 'required|date|before:tomorrow',
            'gender' => 'required',
            'user_zipcode' => 'required',
        ];
    }
}
