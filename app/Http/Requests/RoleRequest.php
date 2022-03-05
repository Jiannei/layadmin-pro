<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class RoleRequest extends FormRequest
{
    protected $defaultValidator = false;

    public function rules($method)
    {
        return match ($method) {
            'store' => [
                'name' => 'required|string|unique:roles',
                'guard_name' => 'required|string',
                'description' => 'nullable',
            ],
            'update' => [
                'name' => [
                    'required',
                    'string',
                    Rule::unique('roles')->ignore($this->route('id')),
                ],
                'guard_name' => 'required|string',
                'description' => 'nullable',
            ],
        };
    }
}
