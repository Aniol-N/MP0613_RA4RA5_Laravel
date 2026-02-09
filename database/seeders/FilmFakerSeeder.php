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
                'name'       => $faker->realText(50),
                'year'       => $faker->year(),
                'genre'      => $faker->randomElement(['Drama', 'Acción', 'Comedia', 'Terror', 'Sci-Fi']),
                'country'    => $faker->country(),
                'duration'   => $faker->numberBetween(80, 240),
                'img_url'    => $faker->imageUrl(640, 480, 'movies', true),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
