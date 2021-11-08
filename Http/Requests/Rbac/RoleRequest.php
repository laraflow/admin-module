<?php

namespace Modules\Admin\Http\Requests\Rbac;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * check using laravel polices
     *
     * @return bool
     */
    public function authorize(): bool
    {
        /*return request()->user()->can('roles.store') ||
            request()->user()->can('roles.update');*/
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
            'name' => 'required|string|min:3|max:255',
            'guard_name' => 'nullable|string|min:3|max:255',
            'enabled' => 'required|string|min:2|max:3',
            'remarks' => 'nullable|string|min:3|max:255',

        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes(): array
    {
        return [
            'guard_name' => 'Guard',
        ];
    }

}
