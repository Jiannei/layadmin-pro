<?php

namespace App\Presenters;

use App\Transformers\Activity\ActionTransformer;
use App\Transformers\Activity\VisitTransformer;

/**
 * Class ActivityPresenter.
 *
 * @package namespace App\Repositories\Presenters;
 */
class ActivityPresenter extends Presenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        if (request('transformer') === 'action') {
            return new ActionTransformer();
        }

        return new VisitTransformer();
    }
}
