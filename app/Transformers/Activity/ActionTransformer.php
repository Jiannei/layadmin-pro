<?php

namespace App\Transformers\Activity;

use Carbon\CarbonInterface;
use League\Fractal\TransformerAbstract;
use Spatie\Activitylog\Models\Activity;

class ActionTransformer extends TransformerAbstract
{
    /**
     * Transform the Activity entity.
     *
     * @param Activity $model
     *
     * @return array
     */
    public function transform(Activity $model)
    {
        return [
            'id' => (int)$model->id,
            'log_name' => $model->log_name,
            'action_type' => $model->description,
            'subject_id' => $model->subject_id,

            'properties' => json_encode($model->properties,JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT),

            'causer' => optional($model->causer)->name,// 登录失效，跳转到登录页前发送的请求没有 causer
            'created_at' => $model->created_at->format(CarbonInterface::DEFAULT_TO_STRING_FORMAT),
        ];
    }
}