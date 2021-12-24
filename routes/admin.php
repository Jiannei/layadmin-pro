<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\LogsController;
use App\Http\Controllers\Api\MenusController;
use App\Http\Controllers\Api\OptionsController;
use App\Http\Controllers\Api\PagesController;
use Illuminate\Support\Facades\Route;
use Jiannei\LayAdmin\Support\Facades\LayAdmin;

// 后台页面路由
Route::prefix(config('layadmin.path.prefix'))->middleware('admin.bootstrap')->group(function () {
    Route::get('/login', LayAdmin::view())->middleware('guest:admin');// 登录页

    Route::middleware('auth:admin')->group(function () {
        Route::get('/home', LayAdmin::view())->name('admin.home');// 主页面路由

        Route::get('/{path}', LayAdmin::view())->where('path', '.+');// 核心路由
    });
});

// 后台 API
Route::prefix('api')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);// 登录
    Route::delete('/logout', [AuthController::class, 'logout']);// 注销

    Route::middleware('auth:admin')->group(function () {
        // 公用接口
        Route::delete('clear', [AdminController::class, 'clear']);// 缓存清理
        Route::get('options/{keyword}', [OptionsController::class, 'options']);// 页面下拉选项

        // 页面管理
        Route::get('pages', [PagesController::class, 'index']);
        Route::get('pages/{id}', [PagesController::class, 'show']);
        Route::put('pages/sync', [PagesController::class, 'sync']);

        // 菜单管理
        Route::get('menus/search', [MenusController::class, 'search']);
        Route::get('menus', [MenusController::class, 'index']);
        Route::get('menus/{id}', [MenusController::class, 'show']);
        Route::put('menus/{id}', [MenusController::class, 'update']);
        Route::patch('menus/{id}/sort', [MenusController::class, 'updateSort']);
        Route::post('menus', [MenusController::class, 'store']);
        Route::delete('menus/{id}', [MenusController::class, 'destroy']);

        // 日志管理
        Route::get('logs', [LogsController::class, 'index']);
        Route::delete('logs/{name}', [LogsController::class, 'destroy']);
    });
});
