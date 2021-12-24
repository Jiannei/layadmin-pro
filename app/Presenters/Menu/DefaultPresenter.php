<?php

namespace App\Presenters\Menu;

use App\Presenters\Presenter;
use App\Transformers\MenuTransformer;

/**
 * Class MenuPresenter.
 *
 * @package namespace App\Presenters;
 */
class DefaultPresenter extends Presenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new MenuTransformer();
    }
}
