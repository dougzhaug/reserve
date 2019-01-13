<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $insertData = [
            [
                'id' => 1,
                'name' => 'index',
                'title' => '首页',
                'guard_name' => 'agent',
                'pid' => 0,
                'url' => '/',
                'sort' => 0,
                'icon' => 'fa fa-home',
                'is_nav' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 10,
                'name' => 'system_manage',
                'title' => '系统管理',
                'guard_name' => 'agent',
                'pid' => 0,
                'url' => '',
                'sort' => 0,
                'icon' => 'fa fa-gears',
                'is_nav' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            /* 管理员管理 */
            [
                'id' => 100,
                'name' => 'admin',
                'title' => '管理员管理',
                'guard_name' => 'admin',
                'pid' => 10,
                'url' => '',
                'sort' => 3,
                'icon' => 'fa fa-user',
                'is_nav' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 101,
                'name' => 'admin.create',
                'title' => '添加管理员',
                'guard_name' => 'admin',
                'pid' => 100,
                'url' => '',
                'sort' => 0,
                'icon' => '',
                'is_nav' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 102,
                'name' => 'admin.show',
                'title' => '展示管理员',
                'guard_name' => 'admin',
                'pid' => 100,
                'url' => '',
                'sort' => 0,
                'icon' => '',
                'is_nav' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 103,
                'name' => 'admin.edit',
                'title' => '修改管理员',
                'guard_name' => 'admin',
                'pid' => 100,
                'url' => '',
                'sort' => 0,
                'icon' => '',
                'is_nav' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 104,
                'name' => 'admin.destroy',
                'title' => '删除管理员',
                'guard_name' => 'admin',
                'pid' => 100,
                'url' => '',
                'sort' => 0,
                'icon' => '',
                'is_nav' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            /*代理商管理*/
            [
                'id' => 110,
                'name' => 'agents',
                'title' => '代理商管理',
                'guard_name' => 'agent',
                'pid' => 10,
                'url' => '',
                'sort' => 0,
                'icon' => 'fa fa-user',
                'is_nav' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 111,
                'name' => 'agents.create',
                'title' => '添加代理商',
                'guard_name' => 'agent',
                'pid' => 110,
                'url' => '',
                'sort' => 0,
                'icon' => '',
                'is_nav' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 112,
                'name' => 'agents.show',
                'title' => '展示代理商',
                'guard_name' => 'agent',
                'pid' => 110,
                'url' => '',
                'sort' => 0,
                'icon' => '',
                'is_nav' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 113,
                'name' => 'agents.edit',
                'title' => '修改代理商',
                'guard_name' => 'agent',
                'pid' => 110,
                'url' => '',
                'sort' => 0,
                'icon' => '',
                'is_nav' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 114,
                'name' => 'agents.destroy',
                'title' => '删除管理员',
                'guard_name' => 'agent',
                'pid' => 110,
                'url' => '',
                'sort' => 0,
                'icon' => '',
                'is_nav' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            /* 角色管理 */
            [
                'id' => 200,
                'name' => 'roles',
                'title' => '角色管理',
                'guard_name' => 'agent',
                'pid' => 10,
                'url' => 'roles',
                'sort' => 2,
                'icon' => 'fa fa-puzzle-piece',
                'is_nav' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 201,
                'name' => 'roles.create',
                'title' => '添加角色',
                'guard_name' => 'agent',
                'pid' => 200,
                'url' => 'roles/create',
                'sort' => 0,
                'icon' => '',
                'is_nav' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 202,
                'name' => 'roles.show',
                'title' => '展示角色',
                'guard_name' => 'agent',
                'pid' => 200,
                'url' => '',
                'sort' => 0,
                'icon' => '',
                'is_nav' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 203,
                'name' => 'roles.edit',
                'title' => '修改角色',
                'guard_name' => 'agent',
                'pid' => 200,
                'url' => 'roles/edit',
                'sort' => 0,
                'icon' => '',
                'is_nav' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 204,
                'name' => 'roles.destroy',
                'title' => '删除角色',
                'guard_name' => 'agent',
                'pid' => 200,
                'url' => '',
                'sort' => 0,
                'icon' => '',
                'is_nav' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 205,
                'name' => 'roles.status',
                'title' => '角色状态',
                'guard_name' => 'agent',
                'pid' => 200,
                'url' => '',
                'sort' => 0,
                'icon' => '',
                'is_nav' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 206,
                'name' => 'roles.permission_tree',
                'title' => '权限节点树',
                'guard_name' => 'agent',
                'pid' => 200,
                'url' => '',
                'sort' => 0,
                'icon' => '',
                'is_nav' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            /* 权限管理 */
            [
                'id' => 300,
                'name' => 'permissions',
                'title' => '权限管理',
                'guard_name' => 'agent',
                'pid' => 10,
                'url' => 'permissions',
                'sort' => 1,
                'icon' => 'fa fa-sitemap',
                'is_nav' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 301,
                'name' => 'permissions.create',
                'title' => '添加权限',
                'guard_name' => 'agent',
                'pid' => 300,
                'url' => 'permissions/create',
                'sort' => 0,
                'icon' => '',
                'is_nav' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 302,
                'name' => 'permissions.show',
                'title' => '展示权限',
                'guard_name' => 'agent',
                'pid' => 300,
                'url' => '',
                'sort' => 0,
                'icon' => '',
                'is_nav' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 303,
                'name' => 'permissions.edit',
                'title' => '修改权限',
                'guard_name' => 'agent',
                'pid' => 300,
                'url' => '',
                'sort' => 0,
                'icon' => '',
                'is_nav' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 304,
                'name' => 'permissions.destroy',
                'title' => '删除权限',
                'guard_name' => 'admin',
                'pid' => 300,
                'url' => '',
                'sort' => 0,
                'icon' => '',
                'is_nav' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 305,
                'name' => 'permissions.sort',
                'title' => '排序权限',
                'guard_name' => 'agent',
                'pid' => 300,
                'url' => '',
                'sort' => 0,
                'icon' => '',
                'is_nav' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            /* 默认选中项 */
        ];

        DB::table('permissions')->insert($insertData);
    }
}
