<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customers;
use Faker\Factory as Faker;
use DB;

class CustomersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Customers::truncate();
        
        $faker = Faker::create('App\Models\Customers');

        for($i = 1; $i <= 500; $i++ ){
                DB::table('customers')->insert([
                'name' => $faker->name,
                'adress' => $faker->address,
                'gender' => $faker->randomElement(['male', 'female']),
                'age' => rand(18,60),
            ]);
        }
    }
}
