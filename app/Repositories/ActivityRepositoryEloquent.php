<?php

namespace App\Repositories;

use App\Contracts\ActivityRepository;
use App\Presenters\ActivityPresenter;
use App\Validators\ActivityValidator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;
use Spatie\Activitylog\Models\Activity;

/**
 * Class ActivityRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ActivityRepositoryEloquent extends BaseRepository implements ActivityRepository
{
    protected $fieldSearchable = [
        'log_name',
    ];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Activity::class;
    }

    public function presenter()
    {
        return ActivityPresenter::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
