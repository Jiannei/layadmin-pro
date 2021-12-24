<?php

use Illuminate\Support\Facades\Route;
use Jiannei\LayAdmin\Support\Facades\LayAdmin;

// 页面路由
Route::get('/login', LayAdmin::view())->middleware('guest:admin');// 登录页

Route::middleware('auth:admin')->group(function () {
    Route::get('/home', LayAdmin::view())->name('admin.home');// 主页面路由

    Route::get('/{path}', LayAdmin::view())->where('path', '.+');// 核心路由
});