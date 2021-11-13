<?php

namespace Modules\Admin\Http\Requests\Rbac;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
    public function rules()
    {
        return [
            'name' => 'required|string|min:3|max:255',
            'username' => 'nullable|string|min:5|max:255|unique:users,username,' . $this->user,
            'email' => 'required|string|min:3|max:255|email|unique:App\Models\Auth\User,email,' . $this->user,
            'mobile' => 'required|string|min:11|max:13',
            'password' => (empty($this->user) ? 'required|confirmed|' : 'nullable|') . 'string|min:' . config('auth.minimum_password_length') . '|max:255',
            'photo' => 'nullable|image|max:10000',
            'enabled' => 'nullable|string|min:2|max:3',
            'role_id' => 'required|array|min:1|max:3',
            'role_id.*' => 'required|integer|min:1|max:255',
            'remarks' => 'nullable|string|min:3|max:255'
        ];
    }
}
