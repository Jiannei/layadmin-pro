<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\LogService;
use Jiannei\Response\Laravel\Support\Facades\Response;

class LogsController extends Controller
{
    /**
     * @var LogService
     */
    private $service;

    public function __construct(LogService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $logList = $this->service->searchPage();

        return Response::success($logList);
    }

    public function destroy($name = null)
    {
        $this->service->clean($name ?? 'visit');

        $days = config('activitylog.delete_records_older_than_days');

        return Response::ok("清除[$days]天前日志成功");
    }
}