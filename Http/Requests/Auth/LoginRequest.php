<?php

namespace Modules\Admin\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Admin\Rules\MaxLength;
use Modules\Admin\Rules\MinLength;
use Modules\Admin\Rules\PhoneNumber;
use Modules\Admin\Rules\Username;
use Modules\Admin\Supports\Constant;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $rules = [];

        //Credential Field
        if (config('auth.credential_field') == Constant::LOGIN_EMAIL
            || (config('auth.credential_field') == Constant::LOGIN_OTP
                && config('auth.credential_otp_field') == Constant::OTP_EMAIL)) {
            $rules['email'] = 'required|min:10|max:255|string|email';

        } elseif (config('auth.credential_field') == Constant::LOGIN_MOBILE
            || (config('auth.credential_field') == Constant::LOGIN_OTP
                && config('auth.credential_otp_field') == Constant::OTP_MOBILE)) {
            $rules['mobile'] = ['required','string','min:11','max:11', new PhoneNumber];

        } elseif (config('auth.credential_field') == Constant::LOGIN_USERNAME) {
            $rules['username'] = ['required', new Username, 'min:5', 'max:255', 'string'];
        }

        //Password Field
        if (config('auth.credential_field') != Constant::LOGIN_OTP) {
            $rules['password'] = ['required', 'min:' . config('auth.minimum_password_length'), 'max:255', 'string'];
        }

        return $rules;
    }

}
