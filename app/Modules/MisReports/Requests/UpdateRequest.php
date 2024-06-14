<?php

namespace App\Modules\Users\Requests;

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
            'first_name'        => ['required', 'string', 'max:255'],
            'last_name'         => ['required', 'string', 'max:255'],
            'status'            => ['required'],
            'login_status'      => ['required'],
            'email'             => ['unique:users,email,'.$this->get('id').',id,deleted,0'],
            'user_name'         => ['required', 'max:255', 'unique:users,user_name,'.$this->get('id').',id,deleted,0'],
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
            'first_name.required'               => __('The :attribute field is required', ['attribute' => __('First Name')]),
            'last_name.required'                => __('The :attribute field is required', ['attribute' => __('Last Name')]),
            'status.required'                   => __('The :attribute field is required', ['attribute' => __('Status')]),
            'login_status.required'             => __('The :attribute field is required', ['attribute' => __('Login Status')]),
            'user_name.required'                => __('The :attribute field is required', ['attribute' => __('User Name')]),
            'email.unique'                      => 'The email has already been taken',
            'user_name.unique'                  => 'The user name has already been taken',
        ];
    }
}
