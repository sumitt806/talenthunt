<?php

namespace App\Http\Requests;

use App\Models\SalaryCurrency;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSalaryCurrencyRequest extends FormRequest
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
        $rules = SalaryCurrency::$rules;
        $rules['currency_name'] = 'required|unique:salary_currencies,currency_name,'.$this->route('salaryCurrency')->id;

        return $rules;
    }
}
