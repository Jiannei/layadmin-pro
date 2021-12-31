<?php

namespace App\Http\Controllers\Api;

use App\Enums\ResponseCodeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Services\UserService;
use Jiannei\Response\Laravel\Support\Facades\Response;

class UsersController extends Controller
{
    public function __construct(private UserService $service)
    {
    }

    public function index()
    {
        $userList = $this->service->searchPage();

        return Response::success($userList);
    }

    public function store(UserRequest $request)
    {
        $this->service->createItem($request);

        return Response::localize(ResponseCodeEnum::SERVICE_CREATE_SUCCESS);
    }

    public function show($id)
    {
        $user = $this->service->searchItem($id);

        return Response::success($user);
    }

    public function update(UserRequest $request, $id)
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