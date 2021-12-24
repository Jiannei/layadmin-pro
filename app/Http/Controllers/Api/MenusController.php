<?php

namespace App\Http\Controllers\Api;

use App\Enums\ResponseCodeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\MenuRequest;
use App\Services\MenuService;
use Jiannei\Response\Laravel\Support\Facades\Response;

class MenusController extends Controller
{
    /**
     * @var MenuService
     */
    private $service;

    public function __construct(MenuService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $menuList = $this->service->searchPage();

        return Response::success($menuList);
    }

    public function show($id)
    {
        $menu = $this->service->searchItem($id);

        return Response::success($menu);
    }

    public function update(MenuRequest $request, $id)
    {
        $this->service->updateItem($request, $id);

        return Response::localize(ResponseCodeEnum::SERVICE_UPDATE_SUCCESS);
    }

    public function updateOrder(MenuRequest $request, $id)
    {
        $this->service->updateOrder($id, $request->get('order'));

        return Response::localize(ResponseCodeEnum::SERVICE_UPDATE_SUCCESS);
    }

    public function store(MenuRequest $request)
    {
        $this->service->addItem($request);

        return Response::localize(ResponseCodeEnum::SERVICE_CREATE_SUCCESS);
    }

    public function destroy($id)
    {
        $this->service->removeItem($id);

        return Response::localize(ResponseCodeEnum::SERVICE_DELETE_SUCCESS);
    }

    public function search()
    {
        return $this->service->search();
    }
}