<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserRequest extends FormRequest
{
    protected $defaultValidator = false;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules($method)
    {
        return match ($method) {
            'store' => [
                'name' => 'required|string|unique:users',
                'email' => 'required|email|unique:users',
                'password' => [
                    'required',
                    Password::min(8)
                ],
            ],
            'update' => [
                'email' => [
                    'required',
                    'email',
                    Rule::unique('users')->ignore($this->route('id')),
                ],
                'password' => [
                    'nullable',
                    Password::min(8)
                ],
            ],
        };
    }
}
