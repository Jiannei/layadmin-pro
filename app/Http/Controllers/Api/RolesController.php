<?php

namespace App\Http\Controllers\Api;

use App\Enums\ResponseCodeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Services\RoleService;
use Jiannei\Response\Laravel\Support\Facades\Response;

class RolesController extends Controller
{
    public function __construct(private RoleService $service)
    {

    }

    public function index()
    {
        $roleList = $this->service->searchPage();

        return Response::success($roleList);
    }

    public function store(RoleRequest $request)
    {
        $this->service->createItem($request);

        return Response::localize(ResponseCodeEnum::SERVICE_CREATE_SUCCESS);
    }

    public function show($id)
    {
        $user = $this->service->searchItem($id);

        return Response::success($user);
    }

    public function update(RoleRequest $request, $id)
    {
        $this->service->updateItem($request, $id);

        return Response::localize(ResponseCodeEnum::SERVICE_UPDATE_SUCCESS);
    }

    public function destroy($id)
    {
        $this->service->deleteItem($id);

        return Response::localize(ResponseCodeEnum::SERVICE_DELETE_SUCCESS);
    }
}