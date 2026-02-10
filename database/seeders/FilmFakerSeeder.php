<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;


class FilmFakerSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();
        for ($i = 0; $i < 10; $i++) {
            DB::table('films')->insert([
                'name'       => substr($faker->realText(50), 0, 100),
                'year'       => $faker->year(),
                'genre'      => substr($faker->word, 0, 50),
                'country'    => substr($faker->country, 0, 30),
                'duration'   => $faker->numberBetween(80, 240),
                'img_url'    => $faker->imageUrl(640, 480, 'movies', true),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
