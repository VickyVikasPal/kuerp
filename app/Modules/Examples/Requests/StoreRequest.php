<?php

namespace App\Modules\Examples\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
  public function rules()
  {
    return [
      //  'name' => ['required', 'max:255', 'unique:user_roles,name'],
    ];
  }
  public function messages()
  {
    return [
      //  'name.required' => __('The :attribute field is required', ['attribute' => __('name')]),
    ];
  }
}
