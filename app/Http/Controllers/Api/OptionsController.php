<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\OptionService;
use Illuminate\Http\Request;
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

    public function options(Request $request, $keyword)
    {
        $options = [];
        if (method_exists($this->service, $method = $keyword)) {
            $options = $this->service->$method($request);
        }

        return Response::success($options);
    }
}