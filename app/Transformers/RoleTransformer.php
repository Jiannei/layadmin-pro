<?php

namespace App\Transformers;

use App\Models\Role;
use League\Fractal\TransformerAbstract;

/**
 * Class RoleTransformer.
 *
 * @package namespace App\Transformers;
 */
class RoleTransformer extends TransformerAbstract
{
    /**
     * Transform the Role entity.
     *
     * @param \App\Models\Role $model
     *
     * @return array
     */
    public function transform(Role $model)
    {
        $data = $model->transform();
        $data['description'] = $model->description;
        $data['builtin'] = $model->builtin;

        return $data;
    }
}
