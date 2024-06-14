<?php

namespace App\Modules\Branchs\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
          //  'name' => ['required', 'max:255', 'unique:user_roles,name'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
          //  'name.required' => __('The :attribute field is required', ['attribute' => __('name')]),
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
}
