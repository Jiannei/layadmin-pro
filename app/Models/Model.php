<?php


namespace App\Models;


use App\Support\Traits\SerializeDate;
use Illuminate\Database\Eloquent\Model as BaseModel;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

abstract class Model extends BaseModel implements Transformable
{
    use SerializeDate, TransformableTrait;
}
