<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Actor;

class ActorController extends Controller
{

    public static function readActors(): array
    {
        $actors = Actor::all();
        return $actors->toArray();
    }

    public function listActors()
    {
        $title = "Listado de Actores";
        $actors = ActorController::readActors();

        return view('actors.list', ["actors" => $actors, "title" => $title]);
    }

    public function searchActorsByDecade()
    {
        return view('actors.searchByDecade');
    }

    public function listActorsByDecade(Request $request, $decade = null)
    {
        $actors_filtered = [];

        $title = "Listado de Actores";
        $actors = ActorController::readActors();

        if (is_null($decade)) {
            $decade = $request->input('decade');
        }

        if (is_null($decade)) {
            return view('actors.list', ["actors" => $actors, "title" => $title]);
        }

        $decadeStart = intval($decade);
        $decadeEnd = $decadeStart + 9;

        foreach ($actors as $actor) {
            $year = isset($actor['birthdate']) ? intval(substr($actor['birthdate'], 0, 4)) : 0;
            if ($year >= $decadeStart && $year <= $decadeEnd) {
                $actors_filtered[] = $actor;
            }
        }

        $title = "Actores nacidos en la década de los $decade";
        return view('actors.list', ["actors" => $actors_filtered, "title" => $title]);
    }
    public function countActors()
    {
        $counter = 0;
        $title = "Contar Actores";
        $actors = self::readActors();

        $counter = count($actors);
        return view('actors.count', ["count" => $counter, "title" => $title]);
    }

    public function deleteActor($id)
    {
        $actor = Actor::find($id);
        if ($actor) {
            $actor->delete();
        }
        return redirect()->route('listActors');
    }
}
