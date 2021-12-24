<?php

namespace App\Services;

use App\Contracts\MenuRepository;
use App\Contracts\PageRepository;
use Illuminate\Http\Request;

class OptionService extends Service
{
    private $menuRepository;

    private $pageRepository;

    public function __construct(MenuRepository $menuRepository, PageRepository $pageRepository)
    {
        $this->menuRepository = $menuRepository;
        $this->pageRepository = $pageRepository;
    }

    public function menuType(Request $request)
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

    public function menuOpenType(Request $request)
    {
        return [
            [
                'name' => '_iframe',
                'value' => '_iframe'
            ],
        ];
    }

    public function menuTree(Request $request)
    {
        return $this->menuRepository->searchTree();
    }

    public function pages(Request $request)
    {
        $pages = $this->pageRepository->with('menu')->findWhere(['menu_id' => 0]);

        return collect($pages['list'])->map(function ($item) {
            return [
                'name' => $item['title'],
                'value' => $item['uri'],
            ];
        });
    }
}