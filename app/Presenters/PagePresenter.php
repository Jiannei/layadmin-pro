<?php

namespace App\Presenters;

use App\Transformers\PageTransformer;

/**
 * Class PagePresenter.
 *
 * @package namespace App\Presenters;
 */
class PagePresenter extends Presenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new PageTransformer();
    }
}
