<?php

namespace App\Http\Controllers\Api;

use App\Enums\ResponseCodeEnum;
use App\Http\Controllers\Controller;
use App\Services\PageService;
use Illuminate\Http\Request;
use Jiannei\Response\Laravel\Support\Facades\Response;

class PagesController extends Controller
{
    /**
     * @var PageService
     */
    private $service;

    public function __construct(PageService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $pageList = $this->service->searchPage($request);

        return Response::success($pageList);
    }

    public function sync()
    {
        $this->service->sync();

        return Response::ok('', ResponseCodeEnum::SERVICE_PAGE_SYNC_SUCCESS);
    }

    public function show($id)
    {
        $page = $this->service->searchItem($id);

        return Response::success($page);
    }
}