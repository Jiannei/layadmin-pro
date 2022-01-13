<?php

/*
 * This file is part of the jiannei/layadmin.
 *
 * (c) jiannei <longjian.huang@foxmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\LogsController;
use App\Http\Controllers\Api\MenusController;
use App\Http\Controllers\Api\OptionsController;
use App\Http\Controllers\Api\PagesController;
use App\Http\Controllers\Api\SchedulesController;
use App\Http\Controllers\Api\UsersController;
use Illuminate\Support\Facades\Route;

// 无需授权的接口
Route::post('/login', [AuthController::class, 'login']);// 登录

// 需授权的接口
Route::middleware('auth:admin')->group(function () {
    Route::delete('/logout', [AuthController::class, 'logout']);// 注销

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
    Route::patch('menus/{id}/order', [MenusController::class, 'updateOrder']);
    Route::post('menus', [MenusController::class, 'store']);
    Route::delete('menus/{id}', [MenusController::class, 'destroy']);

    // 用户管理
    Route::get('users', [UsersController::class, 'index']);
    Route::get('users/{id}', [UsersController::class, 'show']);
    Route::put('users/{id}', [UsersController::class, 'update']);
    Route::post('users', [UsersController::class, 'store']);
    Route::delete('users/{id}', [UsersController::class, 'destroy']);

    // 日志管理
    Route::get('logs', [LogsController::class, 'index']);
    Route::delete('logs/{name}', [LogsController::class, 'destroy']);

    // 计划任务
    Route::get('schedules', [SchedulesController::class, 'index']);
    Route::get('schedules/{id}', [SchedulesController::class, 'show']);
    Route::put('schedules/{id}', [SchedulesController::class, 'update']);
    Route::post('schedules', [SchedulesController::class, 'store']);
    Route::delete('schedules/{id}', [SchedulesController::class, 'destroy']);
});