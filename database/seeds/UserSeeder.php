<?php

use App\Role;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'firstname' => 'super',
            'middlename' => 'duper',
            'lastname' => 'admin',
            'username' => 'admin',
            'password' => '$2y$10$s8fufLQhRKZt4nmjO/gQtOJSDkNwNSDWXnXk4t843Wdv0kImefYeW', // admin
            'remember_token' => Str::random(10)
        ]);

        $user->roles()->attach(Role::first());
    }
}
