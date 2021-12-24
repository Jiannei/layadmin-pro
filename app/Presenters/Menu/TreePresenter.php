<?php

namespace App\Presenters\Menu;

use App\Presenters\Presenter;
use App\Transformers\MenuTransformer;
use Jiannei\Response\Laravel\Support\Serializers\SimpleArraySerializer;

class TreePresenter extends Presenter
{
    public function getTransformer()
    {
        return new MenuTransformer();
    }

    public function serializer()
    {
        return new SimpleArraySerializer();
    }
}