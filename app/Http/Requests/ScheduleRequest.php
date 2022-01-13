<?php

namespace App\Http\Requests;

class ScheduleRequest extends FormRequest
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
            'update', 'store' => [
                'command' => 'required|string',
                'description' => 'required|string',
                'parameters' => 'sometimes|nullable|string',
                'expression' => 'required|cron_expression',
                'active' => 'sometimes|accepted',
                'timezone' => 'required|timezone',
                'environments' => 'required|string',
                'without_overlapping' => 'sometimes|nullable|integer',
                'on_one_server' => 'sometimes|accepted',
                'in_background' => 'sometimes|accepted',
                'in_maintenance_mode' => 'sometimes|accepted',
                'output_file_path' => 'sometimes|nullable|string',
                'output_append' => 'sometimes|accepted',
                'output_email' => 'sometimes|nullable|email',
                'output_email_on_failure' => 'sometimes|accepted',
            ],
        };
    }
}
