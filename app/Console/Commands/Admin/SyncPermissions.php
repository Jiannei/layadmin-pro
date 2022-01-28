<?php

namespace App\Console\Commands\Admin;

use App\Enums\RoleEnum;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Jiannei\LayAdmin\Support\Facades\LayAdmin;
use Spatie\Permission\PermissionRegistrar;

class SyncPermissions extends Command
{
    protected $name = 'admin:sync-permissions';

    protected $description = '根据页面配置初始化角色和权限';

    public function handle(): int
    {
        $this->info('初始化开始');

        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $tableNames = config('permission.table_names');

        DB::statement('SET FOREIGN_KEY_CHECKS = 0'); // 禁用外键约束

        DB::table($tableNames['roles'])->truncate();
        DB::table($tableNames['permissions'])->truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS = 1'); // 启用外键约束

        $this->makeRoles();
        $this->makePermissions();

        $this->info('初始化完成');

        return self::SUCCESS;
    }

    protected function makeRoles(): void
    {
        $this->comment('开始生成[角色]');

        collect(RoleEnum::getValues())->map(function ($item) {
            [$guard_name, $name] = explode(':', $item);

            return compact('guard_name', 'name');
        })->each(function ($item) {
            Role::create($item);
        });
    }

    protected function makePermissions(): void
    {
        $this->comment('开始生成[权限]');

        collect(LayAdmin::getPageConfig())->filter(function ($item) {
            return Arr::first($item['components'], function ($value, $key) {
                return Arr::has($value, 'actions');
            });
        })->flatMap(function ($item) {
            $actions = [];
            foreach ($item['components'] as $component) {
                foreach (Arr::get($component, 'actions') as $action) {
                    if (Arr::has($action, 'permission')) {
                        $actions[] = $action['permission'];
                    }
                }
            }

            return array_values($actions);
        })->unique()->each(function ($permission) {
            Permission::create(['name' => $permission, 'guard_name' => config('layadmin.guard')]);
        });
    }
}