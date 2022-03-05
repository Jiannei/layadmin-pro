<?php

namespace App\Services;

use App\Contracts\MenuRepository;
use App\Contracts\PageRepository;

class OptionService extends Service
{
    private $menuRepository;

    private $pageRepository;

    public function __construct(MenuRepository $menuRepository, PageRepository $pageRepository)
    {
        $this->menuRepository = $menuRepository;
        $this->pageRepository = $pageRepository;
    }

    public function menuType()
    {
        return [
            [
                'name' => '目录',
                'value' => 0
            ],
            [
                'name' => '菜单',
                'value' => 1
            ],
        ];
    }

    public function menuOpenType()
    {
        return [
            [
                'name' => '_iframe',
                'value' => '_iframe'
            ],
        ];
    }

    public function environments()
    {
        return [
            [
                'name' => 'local',
                'value' => 'local'
            ],
            [
                'name' => 'production',
                'value' => 'production'
            ],
        ];
    }

    public function menuTree()
    {
        return $this->menuRepository->searchTree();
    }

    public function pages()
    {
        $pages = $this->pageRepository->with('menu')->findWhere(['menu_id' => 0]);

        return collect($pages['list'])->map(function ($item) {
            return [
                'name' => $item['title'],
                'value' => $item['uri'],
            ];
        });
    }

    public function guards()
    {
        return collect(array_keys(config('auth.guards')))->map(function ($item) {
            return [
                'name' => $item,
                'value' => $item,
            ];
        });
    }
}