<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'firstname' => 'test',
            'middlename' => 'test',
            'lastname' => 'customer',
        ]);

        $user->roles()->attach(Role::where('name', 'Customer')->first());

        $user->cust_details()->create([
            'mobile_number' => '09754157431',
            'landline_number' => '(063) 2245748',
            'email' => 'test@test.com',
            'religion' => 'catholic',
            'date_of_birth' => '1991-05-11',
            'age' => '28',
            'place_of_birth' => 'Iligan City',
            'civil_status' => 'Single',
            'educational_attainment' => 'College Grad',
            'employment_type' => 'Self-Employed',
        ]);

        $user->cust_family()->create([
            'father_name' => 'Father',
            'mother_name' => 'Mother',
            'spouse_name' => 'Spouse',
            'dependent1' => '1',
            'dependent2' => '2',
            'dependent3' => '3',
        ]);

        $user->cust_address()->create([
            'present_address' => 'test_address',
            'permanent_address' => 'test_addresss',
            'lat' => '8.242532',
            'lng' => '124.252986',
        ]);

        $user->cust_income()->create([
            'source_of_income' => 'salary',
            'who' => 'maker',
            'amount' => '20000',
        ]);

        $user->cust_income()->create([
            'source_of_income' => 'salary',
            'who' => 'spouse',
            'amount' => '20000',
        ]);

        $user->cust_liability()->create([
            'liability' => 'rent',
            'amount' => '3000'
        ]);

        $user->cust_liability()->create([
            'liability' => 'electricity',
            'amount' => '2000'
        ]);

        $user->cust_self_employed()->create([
            'business_name' => 'LonerDev',
            'nature_of_business' => 'freelancing',
            'address' => 'testAddress',
            'landline_number' => '2255748',
            'mobile_number' => '09754157431'
        ]);

        $user = User::create([
            'firstname' => 'test2',
            'middlename' => 'test2',
            'lastname' => 'customer2',
        ]);

        $user->roles()->attach(Role::where('name', 'Customer')->first());

        $user->cust_details()->create([
            'mobile_number' => '097541574312',
            'landline_number' => '(063) 22457482',
            'email' => 'test2@test.com',
            'religion' => 'catholic2',
            'date_of_birth' => '1992-05-11',
            'age' => '22',
            'place_of_birth' => 'Iligan City2',
            'civil_status' => 'Married',
            'educational_attainment' => 'College Grad',
            'employment_type' => 'Employed',
        ]);

        $user->cust_family()->create([
            'father_name' => 'Father',
            'mother_name' => 'Mother',
            'spouse_name' => 'Spouse',
            'dependent1' => '1',
            'dependent2' => '2',
            'dependent3' => '3',
        ]);

        $user->cust_address()->create([
            'present_address' => 'test_address2',
            'permanent_address' => 'test_address2',
            'lat' => '8.242532',
            'lng' => '124.252986',
        ]);

        $user->cust_income()->create([
            'source_of_income' => 'salary2',
            'who' => 'maker2',
            'amount' => '20000',
        ]);

        $user->cust_income()->create([
            'source_of_income' => 'salary2',
            'who' => 'spouse2',
            'amount' => '20000',
        ]);

        $user->cust_liability()->create([
            'liability' => 'rent2',
            'amount' => '3000'
        ]);

        $user->cust_liability()->create([
            'liability' => 'electricity2',
            'amount' => '2000'
        ]);

        $user->cust_employed()->create([
            'type_of_org' => 'private',
            'company_name' => 'LonerDev',
            'length_of_stay' => '3',
            'address' => 'testAddress',
            'landline_number' => '2255748',
            'mobile_number' => '09754157431',
            'nature_of_business' => 'BPO',
            'position' => 'CEO',
            'employment_status' => 'regular'
        ]);
    }
}
