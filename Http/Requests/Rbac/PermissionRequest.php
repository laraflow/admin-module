<?php

namespace Modules\Admin\Http\Requests\Rbac;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Admin\Supports\Constant;

class PermissionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * check using laravel polices
     *
     * @return bool
     */
    public function authorize(): bool
    {
        /*        return request()->user()->can('permissions.store') ||
                    request()->user()->can('permissions.update');*/
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
            'display_name' => 'required|string|min:3|max:255',
            'name' => 'required|string|min:3|max:255|regex:/^([a-zA-Z0-9\.\-_]+)$/',
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
    public function attributes()
    {
        return [
            'guard_name' => 'Guard',
            'name' => 'Permission Code'
        ];
    }

    public function messages(): array
    {
        return [
            'name.regex' => 'This :attribute field may only alphanumeric, hyphen(-), underscope(_) & fullstops(.)'
        ];
    }

}
