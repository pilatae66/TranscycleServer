<?php

use App\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'branch_name' => 'Iligan',
            'branch_code' => "ILI-01"
        ]);
    }
}
