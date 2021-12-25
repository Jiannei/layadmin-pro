<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menus = [
            [
                'title' => '工作空间',
                'icon' => 'layui-icon layui-icon-console',
                'href' => '',
                'children' => [
                    [
                        "title" => "控制后台",
                        "icon" => "",
                        "open_type" => "_iframe",
                        "href" => "console1",
                    ],
                    [
                        "title" => "数据分析",
                        "icon" => "",
                        "open_type" => "_iframe",
                        "href" => "console2",
                    ],
                ],
            ],
            [
                "title" => "用户管理",
                "icon" => "layui-icon layui-icon-user",
                "href" => "",
                "children" => [
                    [
                        "title" => "权限列表",
                        "icon" => "",
                        "open_type" => "_iframe",
                        "href" => "org/permission/index",
                    ],
                    [
                        "title" => "角色列表",
                        "icon" => "",
                        "open_type" => "_iframe",
                        "href" => "org/role/index",
                    ],
                    [
                        "title" => "用户列表",
                        "icon" => "",
                        "open_type" => "_iframe",
                        "href" => "org/user/index",
                    ],
                ],
            ],
            [
                "title" => "系统管理",
                "icon" => "layui-icon layui-icon-set-fill",
                "href" => "",
                "children" => [
                    [
                        "title" => "页面管理",
                        "icon" => "",
                        "open_type" => "_iframe",
                        "href" => "system/page/index",
                    ],
                    [
                        "title" => "菜单管理",
                        "icon" => "",
                        "open_type" => "_iframe",
                        "href" => "system/menu/index",
                    ],
                    [
                        "title" => "计划任务",
                        "icon" => "",
                        "open_type" => "_iframe",
                        "href" => "system/schedule/index",
                    ],
                    [
                        "title" => "访问日志",
                        "icon" => "",
                        "open_type" => "_iframe",
                        "href" => "system/log/visit",
                    ],
                    [
                        "title" => "操作日志",
                        "icon" => "",
                        "open_type" => "_iframe",
                        "href" => "system/log/action",
                    ],
                ],
            ],
        ];

        Menu::truncate();
        foreach ($menus as $menu) {
            $children = $menu['children'] ?? [];
            unset($menu['children']);

            $menu['creator_id'] = 1;
            $menu['updater_id'] = 1;
            $item = Menu::create($menu);

            foreach ($children as $child) {
                $child['creator_id'] = 1;
                $child['updater_id'] = 1;
                $child['p_id'] = $item['id'];
                Menu::create($child);
            }
        }
    }
}
