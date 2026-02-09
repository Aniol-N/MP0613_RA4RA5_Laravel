<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ActorFakerSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            DB::table('actors')->insert([
                'name' => substr($faker->firstName, 0, 30),
                'surname' => substr($faker->lastName, 0, 30),
                'birthdate' => $faker->date('Y-m-d'),
                'country' => substr($faker->country, 0, 30),
                'img_url' => $faker->imageUrl(640, 480, 'people'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}