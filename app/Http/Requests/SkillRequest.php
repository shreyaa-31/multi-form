<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class SkillRequest extends FormRequest
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
    public function rules(Request $request)
    {
     
        if ($request->id == "") {
            return [
                'skill_name' => 'required|unique:skills',
            ];
        } else {
            return [
                'skill_name' => 'required|unique:skills,skill_name,' . $request->id,
            ];
        }
    }
}
