<?php

namespace App\Services;

use App\Console\Commands\Admin\SyncPages;
use App\Contracts\PageRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Artisan;

class PageService extends Service
{
    private $repository;

    public function __construct(PageRepository $repository)
    {
        $this->repository = $repository;
    }

    public function searchPage(Request $request)
    {
        return $this->repository->with('menu')->paginate($request['limit'] ?? 15);
    }

    public function sync()
    {
        Artisan::call(SyncPages::class);
    }

    public function searchItem($id)
    {
        $page = $this->repository->find($id);

        return Arr::only($page, ['uri', 'title', 'layout', 'view', 'styles', 'scripts', 'components']);
    }
}