<?php

use Illuminate\Support\Facades\Route;
use Jiannei\LayAdmin\Support\Facades\LayAdmin;

Route::get('/login', LayAdmin::view());

// 页面路由
Route::get('/home', LayAdmin::view())->name('admin.home');

Route::get('/{path}', LayAdmin::view())->where('path', '.+');
