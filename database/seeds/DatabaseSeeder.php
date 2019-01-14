<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $this->call([
            AdminsTableSeeder::class,
            AgentsTableSeeder::class,
            PermissionsTableSeeder::class,
            RolesTableSeeder::class,
            ModelHasRolesTablesSeeder::class,
            RoleHasPermissionsTableSeeder::class,
        ]);
    }
}
