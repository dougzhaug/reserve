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
        // $this->call(UsersTableSeeder::class);
        $this->call([
            //AdminsTableSeeder::class,
            PermissionsTableSeeder::class,
            //RouteHasPermissionsTableSeeder::class,
            //RolesTableSeeder::class,
            //ModelHasRolesTablesSeeder::class,
        ]);
    }
}
