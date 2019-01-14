<?php

use Illuminate\Database\Seeder;

class AgentsTableSeeder extends Seeder
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
                'id' => 101,
                'openid' => str_random(32),
                'username' => 'admin',
                'nickname' => '管理员',
                'phone' => 18888888888,
                'email' => 'admin@admin.com',
                'password' => bcrypt('admin'),
                'status' => 1,
                'authorize_status' => 1,
            ],
        ];

        DB::table('agents')->insert($insertData);
    }
}
