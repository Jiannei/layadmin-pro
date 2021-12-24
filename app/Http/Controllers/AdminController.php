<?php

namespace App\Http\Controllers;

use App\Enums\ResponseCodeEnum;
use Illuminate\Foundation\Console\OptimizeClearCommand;
use Illuminate\Support\Facades\Artisan;
use Jiannei\Response\Laravel\Support\Facades\Response;

class AdminController extends Controller
{
    public function clear()
    {
        Artisan::call(OptimizeClearCommand::class);

        return Response::ok('', ResponseCodeEnum::SERVICE_CACHE_CLEAR_SUCCESS);
    }
}