<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\OptionService;
use Jiannei\Response\Laravel\Support\Facades\Response;

class OptionsController extends Controller
{
    /**
     * @var OptionService
     */
    private $service;

    public function __construct(OptionService $service)
    {
        $this->service = $service;
    }

    public function options($keyword)
    {
        $options = [];
        if (method_exists($this->service, $method = $keyword)) {
            $options = $this->service->$method();
        }

        return Response::success($options);
    }
}