<?php

namespace App\Repositories;

use App\Contracts\MenuRepository;
use App\Models\Menu;
use App\Presenters\Menu\DefaultPresenter;
use App\Presenters\Menu\TreePresenter;
use App\Validators\MenuValidator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class MenuRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class MenuRepositoryEloquent extends BaseRepository implements MenuRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Menu::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {
        return MenuValidator::class;
    }

    public function presenter()
    {
        return DefaultPresenter::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function searchTree()
    {
        $this->setPresenter(TreePresenter::class);

        return $this->with(['children' => function ($query) {
            $query->orderByDesc('order');
        }])->orderBy('order')->findWhere(['p_id' => 0]);
    }
}
