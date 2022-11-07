<?php

namespace App\Http\Requests;

use App\Models\Company;
use Illuminate\Foundation\Http\FormRequest;

class CreateCompanyRequest extends FormRequest
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
        $rules = Company::$rules;
        $rules['name'] = 'required';
        $rules['email'] = 'required|unique:users,email';
        $rules['password'] = 'required|same:password_confirmation|min:6';
        $rules['phone'] = 'nullable|min:10|max:10';

        return $rules;
    }
}
