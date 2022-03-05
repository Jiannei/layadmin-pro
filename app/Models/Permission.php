<?php

namespace App\Models;

use App\Support\Traits\SerializeDate;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Rinvex\Attributes\Traits\Attributable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Class Permission.
 *
 * @package namespace App\Models;
 */
class Permission extends \Spatie\Permission\Models\Permission implements Transformable
{
    use TransformableTrait, SerializeDate, Attributable,LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('model:'.$this->getTable())
            ->logFillable()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}
