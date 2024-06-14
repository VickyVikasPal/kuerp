<?php

namespace App\Modules\Accounts\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Account;
class UpdatePasswordRequest extends FormRequest
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
      'current_password' => $this->validateCurrentPassword(),
      'password' => ['required', 'min:8', 'confirmed'],
      'password_confirmation' => ['required', 'min:8', ],
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
      'current_password.required' => 'The password field is required.',
      'password.required' => 'The password field is required.',
      'password.min' => 'The password must be at least 8 characters.',
      'password.confirmed' => 'The password confirmation does not match.',
      'password_confirmation.required' => 'The password confirmation field is required.',
      'password_confirmation.min' => 'The password confirmation must be at least 8 characters.',
    ];
  }


  public function validateCurrentPassword()
  {
    return [
      'required',
      function ($attribute, $value, $fail) {
      if (!Hash::check($value, $this->user()->password)) {
        $fail('The current password is incorrect.');
      }
    },
    ];
  }

/**
 * Prepare the data for validation.
 *
 * @return void
 */
}
