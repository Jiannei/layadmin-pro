<?php

namespace App\Http\Requests;

class AuthRequest extends FormRequest
{
    protected $defaultValidator = true;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'required',
            'password' => 'required',
        ];
    }
}
