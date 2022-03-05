<?php

namespace App\Enums;

use Jiannei\Enum\Laravel\Enum;

class PermissionEnum extends Enum
{
    public const SYSTEM = 0;// 系统维护权限
    public const PAGE = 1;// 菜单权限/页面访问权限
    public const ACTION = 2;// 页面操作权限
    public const DATA = 3;// 页面数据权限
    public const FIELD = 4;// 数据字段权限
}