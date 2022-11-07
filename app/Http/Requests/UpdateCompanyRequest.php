<?php

namespace App\Http\Requests;

use App\Models\Company;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyRequest extends FormRequest
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
        $rules['email'] = 'required|unique:users,email,'.$this->input('user_id');
        $rules['password'] = 'nullable|same:password_confirmation|min:6';
        $rules['phone'] = 'nullable';

        return $rules;
    }
}
