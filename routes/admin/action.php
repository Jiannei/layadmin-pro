<?php

// 页面 API
use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);// 登录
Route::delete('/logout', [AuthController::class, 'logout']);// 注销