<?php

namespace Modules\Admin\Http\Requests\Rbac;

use Illuminate\Foundation\Http\FormRequest;

class RolePermissionRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'permissions' => 'required|array',
            'permissions.*' => 'required|integer'
        ];
    }

    public function attributes(): array
    {
        return [
            'permissions.*' => 'Permission(s)'
        ];
    }
}
