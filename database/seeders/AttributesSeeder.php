<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Rinvex\Attributes\Models\Attribute;

class AttributesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 扩展第三方包数据字段（方便后续升级扩展）；业务主表扩充字段
        Attribute::create([
            'slug' => 'description',
            'type' => 'varchar',
            'name' => '描述',
            'entities' => [Role::class, Permission::class],
        ]);

        Attribute::create([
            'slug' => 'builtin',
            'type' => 'boolean',
            'name' => '系统内置',
            'entities' => [Role::class, Permission::class],
        ]);

        Attribute::create([
            'slug' => 'type',
            'type' => 'integer',
            'name' => '类型',
            'entities' => [Permission::class],
        ]);
    }
}
