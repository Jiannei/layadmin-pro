<?php


namespace App\Models;


use App\Support\Traits\SerializeDate;
use Illuminate\Database\Eloquent\Model as BaseModel;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

abstract class Model extends BaseModel implements Transformable
{
    use SerializeDate, TransformableTrait, LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('model:'.$this->getTable())
            ->logFillable()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}
