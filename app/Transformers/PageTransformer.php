<?php

namespace App\Transformers;

use App\Models\Page;
use Carbon\CarbonInterface;
use League\Fractal\TransformerAbstract;

/**
 * Class PageTransformer.
 *
 * @package namespace App\Transformers;
 */
class PageTransformer extends TransformerAbstract
{
    /**
     * Transform the Page entity.
     *
     * @param \App\Models\Page $model
     *
     * @return array
     */
    public function transform(Page $model)
    {
        return [
            'id' => $model->id,
            'uri' => $model->uri,
            'title' => $model->title,
            'layout' => $model->layout,
            'view' => $model->view,
            'styles' => $model->styles ?? [],
            'scripts' => $model->scripts ?? [],
            'components' => $model->components ?? [],

            'status' => $model->status,
            'config' => $model->uri.'.json',
            'menu_title' => optional($model->menu)->title,
            'updated_at' => $model->updated_at->format(CarbonInterface::DEFAULT_TO_STRING_FORMAT),
        ];
    }
}
