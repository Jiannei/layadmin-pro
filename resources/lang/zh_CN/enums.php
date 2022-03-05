<?php

/*
 * This file is part of the Jiannei/lumen-api-starter.
 *
 * (c) Jiannei <longjian.huang@foxmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

use App\Enums\LogEnum;
use App\Enums\ResponseCodeEnum;
use App\Enums\RoleEnum;
use App\Enums\ScheduleEnum;
use Jiannei\Enum\Laravel\Repositories\Enums\HttpStatusCodeEnum;

return [
    // 响应状态码
    ResponseCodeEnum::class => [
        // 成功
        HttpStatusCodeEnum::HTTP_OK => '操作成功', // 自定义 HTTP 状态码返回消息
        HttpStatusCodeEnum::HTTP_INTERNAL_SERVER_ERROR => '操作失败',
        HttpStatusCodeEnum::HTTP_UNPROCESSABLE_ENTITY => '验证失败',
        HttpStatusCodeEnum::HTTP_UNAUTHORIZED => '授权失败',

        // 业务操作成功
        ResponseCodeEnum::SERVICE_CREATE_SUCCESS => '新增成功',
        ResponseCodeEnum::SERVICE_UPDATE_SUCCESS => '更新成功',
        ResponseCodeEnum::SERVICE_DELETE_SUCCESS => '删除成功',
        ResponseCodeEnum::SERVICE_CACHE_CLEAR_SUCCESS => '缓存清除成功',
        ResponseCodeEnum::SERVICE_REGISTER_SUCCESS => '注册成功',
        ResponseCodeEnum::SERVICE_LOGIN_SUCCESS => '登录成功',
        ResponseCodeEnum::SERVICE_LOGOUT_SUCCESS => '注销成功',
        ResponseCodeEnum::SERVICE_PAGE_SYNC_SUCCESS => '同步成功',

        // 业务操作失败：授权业务
        ResponseCodeEnum::SERVICE_REGISTER_ERROR => '注册失败',
        ResponseCodeEnum::SERVICE_LOGIN_ERROR => '用户名或密码错误',

        // 客户端错误
        ResponseCodeEnum::CLIENT_PARAMETER_ERROR => '参数错误',
        ResponseCodeEnum::CLIENT_CREATED_ERROR => '数据已存在',
        ResponseCodeEnum::CLIENT_DELETED_ERROR => '数据不存在',
        ResponseCodeEnum::CLIENT_VALIDATION_ERROR => '表单验证错误',

        // 服务端错误
        ResponseCodeEnum::SYSTEM_ERROR => '服务器错误',
        ResponseCodeEnum::SYSTEM_UNAVAILABLE => '服务器正在维护，暂不可用',
        ResponseCodeEnum::SYSTEM_CACHE_CONFIG_ERROR => '缓存配置错误',
        ResponseCodeEnum::SYSTEM_CACHE_MISSED_ERROR => '缓存未命中',
        ResponseCodeEnum::SYSTEM_CONFIG_ERROR => '系统配置错误',
    ],

    // 日志描述
    LogEnum::class => [
        LogEnum::SYSTEM_SQL => '[系统]SQL',
        LogEnum::SYSTEM_REQUEST => '[系统]请求',
    ],

    // command
    ScheduleEnum::class => [
        ScheduleEnum::GITHUB_TRENDING => '同步 Github Trending',
    ],

    // 系统内置角色
    RoleEnum::class => [
        RoleEnum::SUPER_ADMIN => '超级管理员',
        RoleEnum::ADMIN => '管理员'
    ]
];
