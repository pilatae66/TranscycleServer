<?php

use App\Product;
use App\Role;
use Illuminate\Database\Seeder;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        $this->call([
            RoleSeeder::class
        ]);

        $this->call([
            UserSeeder::class
        ]);

        factory(Product::class, 100)->create();
    }
}
