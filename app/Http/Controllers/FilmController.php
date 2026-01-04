<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class FilmController extends Controller
{

    public static function registerNewFilm()
    {
        $films = Storage::json('/public/films.json');

        $name = request('name');
        $year = request('year');
        $genre = request('genre');
        $img_url = request('img_url');
        $country = request('country');
        $duration = request('duration');

        $films[] = [
            'name' => $name,
            'year' => $year,
            'genre' => $genre,
            'img_url' => $img_url,
            'country' => $country,
            'duration' => $duration
        ];
        Storage::disk('local')->put('/public/films.json', json_encode($films));
        return view('welcome');
    }

    public static function readFilms(): array
    {
        $films = Storage::json('/public/films.json');
        return $films;
    }
  
    public function listOldFilms($year = null)
    {
        $old_films = [];
        if (is_null($year))
            $year = 2000;

        $title = "Listado de Pelis Antiguas (Antes de $year)";
        $films = FilmController::readFilms();

        foreach ($films as $film) {
            //foreach ($this->datasource as $film) {
            if ($film['year'] < $year)
                $old_films[] = $film;
        }
        return view('films.list', ["films" => $old_films, "title" => $title]);
    }

    public function listNewFilms($year = null)
    {
        $new_films = [];
        if (is_null($year))
            $year = 2000;

        $title = "Listado de Pelis Nuevas (Después de $year)";
        $films = FilmController::readFilms();

        foreach ($films as $film) {
            if ($film['year'] >= $year)
                $new_films[] = $film;
        }
        return view('films.list', ["films" => $new_films, "title" => $title]);
    }

    public function listFilms($year = null, $genre = null, $country = null, $duration = null)
    {
        $films_filtered = [];

        $title = "Listado de todas las pelis";
        $films = FilmController::readFilms();

        //if year and genre are null
        if (is_null($year) && is_null($genre))
            return view('films.list', ["films" => $films, "title" => $title]);

        //list based on year or genre informed
        foreach ($films as $film) {
            $match = true;

            if (!is_null($year) && $film['year'] != $year)
                $match = false;

            if (!is_null($genre) && strtolower($film['genre']) != strtolower($genre))
                $match = false;

            if (!is_null($country) && strtolower($film['country']) != strtolower($country))
                $match = false;

            if (!is_null($duration) && $film['duration'] != $duration)
                $match = false;

            if ($match) {
                $films_filtered[] = $film;
            }
        }

        // Construcción dinámica del título
        $filters = [];
        if ($year) $filters[] = "año";
        if ($genre) $filters[] = "género";
        if ($country) $filters[] = "país";
        if ($duration) $filters[] = "duración";

        $title = "Listado filtrado por: " . implode(", ", $filters);

        return view("films.list", ["films" => $films_filtered, "title" => $title]);
    }

    public function listFilmsOrderedByGenre()
    {
        $films = FilmController::readFilms();
        // Ordenar por género alfabéticamente
        usort($films, function ($film1, $film2) {
            return strcmp(strtolower($film1['genre']), strtolower($film2['genre']));
        });
        $title = "Películas ordenadas por género";
        return view("films.list", [
            "films" => $films,
            "title" => $title
        ]);
    }


    public function listFilmsOrderedByYear()
    {
        $films = FilmController::readFilms();
        // Ordenar por año de menor a mayor
        usort($films, function ($film1, $film2) {

            // Si los años son iguales, devuelve 0
            if ($film1['year'] == $film2['year']) {
                return 0;
            }

            // Si el año de A es menor que el de B, devuelve -1 (va antes)
            // Si no, devuelve 1 (va después)
            return ($film1['year'] < $film2['year']) ? -1 : 1;
        });

        $title = "Películas ordenadas por año";
        return view("films.list", [
            "films" => $films,
            "title" => $title
        ]);
    }

    public function countFilms()
    {
        $counter = 0;
        $title = "Contar Películas";
        $films = self::readFilms();

        $counter = count($films);
        return view('count', ["count" => $counter, "title" => $title]);
    }

    /**
     * Check if a film with the given name already exists (case-insensitive).
     */
    public function isFilm(string $name): bool
    {
        $films = self::readFilms();
        foreach ($films as $film) {
            if (isset($film['name']) && strcasecmp(trim($film['name']), trim($name)) === 0) {
                return true;
            }
        }
        return false;
    }

    /**
     * Create a film if it doesn't exist; otherwise redirect to welcome with error.
     * If created, show the list of films.
     */
    public function createFilm(Request $request)
    {
        $name = $request->input('name');

        if ($this->isFilm($name)) {
            return redirect('/')->with('error', 'Error: Ya existe una pelicula con este nombre.');
        }

        $films = Storage::json('/public/films.json');

        $year = $request->input('year');
        $genre = $request->input('genre');
        $img_url = $request->input('img_url');
        $country = $request->input('country');
        $duration = $request->input('duration');

        $films[] = [
            'name' => $name,
            'year' => $year,
            'genre' => $genre,
            'img_url' => $img_url,
            'country' => $country,
            'duration' => $duration
        ];

        Storage::disk('local')->put('/public/films.json', json_encode($films));

        // After adding, show all films
        return $this->listFilms();
    }

    /**
     * Store a film (simple handler). The ValidateUrl middleware runs before this.
     */
    public function storeFilm(Request $request)
    {
        $films = Storage::json('/public/films.json');

        $name = $request->input('name');
        $year = $request->input('year');
        $genre = $request->input('genre');
        $img_url = $request->input('img_url');
        $country = $request->input('country');
        $duration = $request->input('duration');

        $films[] = [
            'name' => $name,
            'year' => $year,
            'genre' => $genre,
            'img_url' => $img_url,
            'country' => $country,
            'duration' => $duration
        ];

        Storage::disk('local')->put('/public/films.json', json_encode($films));

        return redirect('/')->with('success', 'Película agregada correctamente.');
    }
}
