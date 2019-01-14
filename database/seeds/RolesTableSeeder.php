<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
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
                'name' => '总管理员',
                'guard_name' => 'admin',
                'depict' => '拥有最高权限',
                'status' => 1,
                'js_tree_ids' => '',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 10,
                'name' => '总管理员',
                'guard_name' => 'agent',
                'depict' => '代理商总管理员拥有最高权限',
                'status' => 1,
                'js_tree_ids' => '10,110,1100,1110,1120,1130,1140,2100,2101,2102,2103,2104,2105,2106,3100,3101,3102,3103,3104,3105',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];


        DB::table('roles')->insert($insertData);
    }
}
