<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FilmActorSeeder extends Seeder
{
    public function run(): void
    {
        $filmIds = DB::table('films')->pluck('id')->toArray();
        $actorIds = DB::table('actors')->pluck('id')->toArray();

        foreach ($filmIds as $filmId) {
            $randomKeys = (array) array_rand($actorIds, rand(1, 3));

            foreach ($randomKeys as $key) {
                DB::table('films_actors')->insert([
                    'film_id'    => $filmId,
                    'actor_id'   => $actorIds[$key],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}