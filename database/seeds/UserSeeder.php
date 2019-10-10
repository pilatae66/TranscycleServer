<?php

use App\Role;
use App\User;
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
            'password' => bcrypt('admin'), // admin
            'branch_id' => 1,
            'remember_token' => Str::random(10)
        ]);

        $user->roles()->attach(Role::where('name', 'Admin')->first());

        // $user = User::create([
        //     'firstname' => 'super',
        //     'middlename' => 'duper',
        //     'lastname' => 'agent',
        //     'username' => 'agent',
        //     'password' => bcrypt('agent'), // agent
        //     'branch_id' => 1,
        //     'remember_token' => Str::random(10)
        // ]);

        // $user->roles()->attach(Role::where('name', 'Agent')->first());

        // $user = User::create([
        //     'firstname' => 'super',
        //     'middlename' => 'duper',
        //     'lastname' => 'cashier',
        //     'username' => 'cashier',
        //     'password' => bcrypt('cashier'), // cashier
        //     'branch_id' => 1,
        //     'remember_token' => Str::random(10)
        // ]);

        // $user->roles()->attach(Role::where('name', 'Cashier')->first());

        // $user = User::create([
        //     'firstname' => 'super',
        //     'middlename' => 'duper',
        //     'lastname' => 'collector',
        //     'username' => 'collector',
        //     'password' => bcrypt('collector'), // collector
        //     'branch_id' => 1,
        //     'remember_token' => Str::random(10)
        // ]);

        // $user->roles()->attach(Role::where('name', 'Collector')->first());

    }
}
