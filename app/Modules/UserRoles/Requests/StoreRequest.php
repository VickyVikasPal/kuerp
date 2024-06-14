<?php

namespace App\Modules\UserRoles\Requests;

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
         //   'name' => ['required', 'max:255', 'unique:user_roles,name'],
            'name' => ['required', 'min:2', 'unique:user_roles,name,NULL,id,deleted,0'],
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
            'name.required' => __('The :attribute field is required', ['attribute' => __('name')]),
            'name.unique' => 'The user role name has already been taken',
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
   /* protected function prepareForValidation()
    {
        $permissions = [];
        foreach ($this->get('permissions') as $key => $value) {
            if ($value) {
                $permissions[] = $key;
            }
        }
        $this->merge([
            'permissions' => $permissions,
        ]);
    }*/
}
