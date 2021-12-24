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
                'p_id' => 'nullable|integer',
            ],
            'updateOrder' => [
                'order' => 'required|integer',
            ],
        };
    }

    public function attributes()
    {
        return [
            'order' => '排序',
        ];
    }
}
