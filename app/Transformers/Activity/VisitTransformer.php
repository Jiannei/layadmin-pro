<?php

namespace App\Transformers\Activity;

use Carbon\CarbonInterface;
use Jenssegers\Agent\Agent;
use League\Fractal\TransformerAbstract;
use Spatie\Activitylog\Models\Activity;
use function app;
use function optional;

/**
 * Class ActivityTransformer.
 *
 * @package namespace App\Repositories\Transformers;
 */
class VisitTransformer extends TransformerAbstract
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
        $agent = app(Agent::class);
        $agent->setUserAgent($model->properties->get('user_agent'));

        return [
            'id' => (int)$model->id,
            'log_name' => $model->log_name,

            'title' => optional($model->subject)->title,
            'uri' => optional($model->subject)->uri,
            'ip' => $model->properties->get('ip'),
            'method' => $model->properties->get('method'),
            'duration' => $model->properties->get('duration'),
            'browser' => $agent->browser(),
            'platform' => $agent->platform(),

            'causer' => optional($model->causer)->name,// 登录失效，跳转到登录页前发送的请求没有 causer
            'created_at' => $model->created_at->format(CarbonInterface::DEFAULT_TO_STRING_FORMAT),
        ];
    }
}
