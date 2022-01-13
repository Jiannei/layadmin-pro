<?php

namespace App\Models;

use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Permission.
 *
 * @package namespace App\Models;
 */
class Permission extends \Spatie\Permission\Models\Permission implements Transformable
{
    use TransformableTrait;


}
