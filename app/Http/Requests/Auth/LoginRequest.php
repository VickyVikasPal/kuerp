<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'user_name' => ['required'],
            'password' => ['required'],
            'captcha' => $this->getCaptchaValidationRule(),
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
            'user_name.required' => __('The :attribute field is required', ['attribute' => __('email')]),
            //'email.email' => __('The :attribute must be a valid email address', ['attribute' => __('email')]),

            'password.required' => __('The :attribute field is required', ['attribute' => __('password')]),
            'captcha.required' => 'The captcha field is required',
            'captcha.captcha' => 'Please enter the valid captcha'
        ];
    }
    private function getCaptchaValidationRule()
    {
        $loginWithCaptcha = '';
        if(isset(config('config')['login_with_captcha'])){
            $loginWithCaptcha = config('config')['login_with_captcha']; // retrieve the setting value
        }
        

        if ($loginWithCaptcha) {
            return ['required', 'captcha'];
        }

        return [];
    }
}
