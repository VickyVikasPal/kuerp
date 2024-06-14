<?php

namespace App\Modules\PdfSettings\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
       //     'name' => ['required', 'max:255', 'unique:user_roles,name,'.$this->get('id')],
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
     //       'name.required' => __('The :attribute field is required', ['attribute' => __('name')]),
        ];
    }
}
