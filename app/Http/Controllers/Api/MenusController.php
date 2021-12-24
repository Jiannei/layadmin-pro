<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\MenuService;
use Illuminate\Http\Request;
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

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'type' => 'required|integer',
            'icon' => 'required_if:type,0',
            'href' => 'required_if:type,1',
            'open_type' => 'required_if:type,1',
            'sort' => 'required|integer',
            'p_id' => 'nullable|integer',
        ]);

        $this->service->updateItem($request, $id);

        return Response::ok('更新成功');
    }

    public function updateSort(Request $request, $id)
    {
        $this->validate($request, [
            'sort' => 'required|integer',
        ]);

        $this->service->updateSort($id, $request->get('sort'));

        return Response::ok('更新成功');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'type' => 'required|integer',
            'icon' => 'required_if:type,0',
            'href' => 'required_if:type,1',
            'open_type' => 'required_if:type,1',
            'sort' => 'required|integer',
            'p_id' => 'nullable|integer',
        ]);

        $this->service->addItem($request);

        return Response::ok('新增成功');
    }

    public function destroy($id)
    {
        $this->service->removeItem($id);

        return Response::ok('删除成功');
    }

    public function search()
    {
        return $this->service->search();
    }
}