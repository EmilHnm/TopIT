<?php

namespace Database\Seeders;

use App\Models\BussinessAccount;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobFaker extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $position = ['fulltime', 'parttime', 'freelance'];
        $faker = \Faker\Factory::create();
        for($i = 0; $i < 50; $i++) {
            \DB::table('jobs')->insert([
                'bussiness_account_id' => BussinessAccount::inRandomOrder()->first()->id,
                'title' => $faker->jobTitle,
                'description' => $faker->text,
                'position' => $faker->jobTitle,
                'type' => $position[$faker->numberBetween(0,2)],
                'experience_required' => $faker->text,
                'end_date' => $faker->date,
            ]);
        }
    }
}
