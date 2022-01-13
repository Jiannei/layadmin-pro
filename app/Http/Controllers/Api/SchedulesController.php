<?php

namespace App\Http\Controllers\Api;

use App\Enums\ResponseCodeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\ScheduleRequest;
use App\Services\ScheduleService;
use Jiannei\Response\Laravel\Support\Facades\Response;

class SchedulesController extends Controller
{
    public function __construct(private ScheduleService $service)
    {

    }

    public function index()
    {
        $scheduleList = $this->service->searchPage();

        return Response::success($scheduleList);
    }

    public function show($id)
    {
        $schedule = $this->service->searchItem($id);

        return Response::success($schedule);
    }

    public function store(ScheduleRequest $request)
    {
        $this->service->addItem($request);

        return Response::localize(ResponseCodeEnum::SERVICE_CREATE_SUCCESS);
    }

    public function update(ScheduleRequest $request, $id)
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