<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanyFaker extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 10; $i++) {
            DB::table('bussiness_accounts')->insert([
                'name' => $faker->company,
                'introduce' => $faker->text,
                'phone' => $faker->phoneNumber,
                'address' => $faker->address,
                'website' => $faker->domainName,
                'user_id' => 1
            ]);
        }
    }
}
