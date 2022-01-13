<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\PermissionRegistrar;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $tableNames = config('permission.table_names');

        DB::statement('SET FOREIGN_KEY_CHECKS = 0'); // 禁用外键约束

        DB::table($tableNames['roles'])->truncate();
        DB::table($tableNames['permissions'])->truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS = 1'); // 启用外键约束

        collect(RoleEnum::getValues())->map(function ($item) {
            [$guard_name, $name] = explode(':', $item);

            return compact('guard_name', 'name');
        })->each(function ($item) {
            Role::create($item);
        });
    }
}
