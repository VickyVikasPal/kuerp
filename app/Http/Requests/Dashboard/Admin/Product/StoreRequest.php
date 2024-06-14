<?php

namespace App\Http\Requests\Dashboard\Admin\Product;

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
        /* return [
            'category_id' => ['required', 'max:255'],
            'name' => ['required', 'max:255'],
            'price' => ['required', 'max:255'],
            'status' => ['required'],
            'description' => ['required', 'max:255'],
            
        ]; */

        return [
            'editFormData.*' => ['required', 'max:255'],
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
            'category_id.required' => __('The :attribute field is required', ['attribute' => __('name')]),
            'category_id.max' => __('The :attribute may not be greater than :max characters', ['attribute' => __('name'), 'max' => 255]),

            'name.required' => __('The :attribute field is required', ['attribute' => __('name')]),
            'name.max' => __('The :attribute may not be greater than :max characters', ['attribute' => __('name'), 'max' => 255]),

            'price.required' => __('The :attribute field is required', ['attribute' => __('name')]),
            'price.max' => __('The :attribute may not be greater than :max characters', ['attribute' => __('name'), 'max' => 255]),
            

            'status.required' => __('The :attribute field is required', ['attribute' => __('status')]),

            'description.required' => __('The :attribute field is required', ['attribute' => __('role')]),
            'description.exists' => __('The selected :attribute is invalid', ['attribute' => __('role')]),

        ];
    }
}
