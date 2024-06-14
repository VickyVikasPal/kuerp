<?php

namespace App\Http\Requests\Dashboard\Incidents;

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
            'incident.name' => ['required', 'max:255'],
            'incident.type' => ['required', 'integer'],
            'incident.components' => ['array'],
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
            'incident.name.required' => __('The :attribute field is required', ['attribute' => __('name')]),
            'incident.name.max' => __('The :attribute may not be greater than :max characters', ['attribute' => __('name'), 'max' => 255]),

            'incident.type.required' => __('The :attribute field is required', ['attribute' => __('incident type')]),
            'incident.type.integer' => __('The :attribute must be an integer', ['attribute' => __('incident type')]),

            'incident.components.array' => __('The :attribute must be an array', ['attribute' => __('components')]),
        ];
    }
}
