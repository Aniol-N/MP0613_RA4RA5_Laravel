<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class FilmController extends Controller
{

    /**
     * Read films from storage
     */
    public static function readFilms(): array
    {
        $films = Storage::json('/public/films.json');
        return $films;
    }
    /**
     * List films older than input year 
     * if year is not infomed 2000 year will be used as criteria
     */
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
    /**
     * List films younger than input year
     * if year is not infomed 2000 year will be used as criteria
     */
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
    /**
     * Lista TODAS las películas o filtra x año o categoría.
     */
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
}
