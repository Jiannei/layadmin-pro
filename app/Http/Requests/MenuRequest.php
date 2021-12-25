<?php

namespace App\Http\Requests;

class MenuRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules($method)
    {
        return match ($method) {
            'update','store' => [
                'title' => 'required|string',
                'type' => 'required|integer',
                'icon' => 'required_if:type,0',
                'href' => 'required_if:type,1',
                'open_type' => 'required_if:type,1',
                'order' => 'required|integer',
                'p_id' => 'required_if:type,1',
            ],
            'updateOrder' => [
                'order' => 'required|integer',
            ],
        };
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'order' => '排序',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'p_id.required_if' => '必须设置父级菜单',
            'href.required_if' => '必须设置菜单对应的页面',
        ];
    }
}
