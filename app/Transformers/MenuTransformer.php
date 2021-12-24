<?php

namespace App\Transformers;

use App\Models\Menu;
use League\Fractal\TransformerAbstract;

/**
 * Class MenuTransformer.
 *
 * @package namespace App\Transformers;
 */
class MenuTransformer extends TransformerAbstract
{
    /**
     * Transform the Menu entity.
     *
     * @param \App\Models\Menu $model
     *
     * @return array
     */
    public function transform(Menu $model)
    {
        $children = $model->children->map(function ($child) {
            return $child->transform();
        })->all();

        return [
            'id' => $model->id,
            'p_id' => $model->p_id,
            'title' => $model->title,
            'icon' => $model->icon,
            'href' => $model->href,
            'openType' => $model->open_type,
            'children' => $children,

            'type' => $model->p_id ? 1 : 0,
            'parentId' => $model->p_id,
            'last' => !$model->children->count(),
            'order' => $model->order,
        ];
    }
}
