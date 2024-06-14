<?php

namespace App\Modules\DeliveryChallans\Requests;

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
           /* 'name' => ['required'],
            'field_name' => ['required'],
            'seq_no' => ['required'],
            'date_field' => ['required'],*/
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
          //  'username.required' => __('The :attribute field is required', ['attribute' => __('username')]),
        ];
    }
}
