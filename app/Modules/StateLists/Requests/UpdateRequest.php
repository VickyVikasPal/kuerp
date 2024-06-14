<?php

namespace App\Modules\StateLists\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
       //     'name' => ['required', 'max:255', 'unique:user_roles,name,'.$this->get('id')],
        ];
    }
    public function messages()
    {
        return [
     //       'name.required' => __('The :attribute field is required', ['attribute' => __('name')]),
        ];
    }
}
