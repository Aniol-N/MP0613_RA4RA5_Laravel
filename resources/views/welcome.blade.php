@extends('layouts.master')

@section('header')
    <div class="container py-2 d-flex justify-content-between align-items-center">
        <div>
            <span class="nav-home selected">HOME</span>
        </div>
    </div>
@endsection

@section('content')
    <h1 class="mt-4 h1-toggle">REGISTRAR NUEVA PELICULA</h1>
    <div class="collapsible-content">
        <form action="{{ route('film') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="year">Año:</label>
                <input type="number" class="form-control" id="year" name="year" required>
            </div>
            <div class="form-group">
                <label for="genre">Género:</label>
                <input type="text" class="form-control" id="genre" name="genre" required>
            </div>
            <div class="form-group">
                <label for="img_url">URL de la imagen:</label>
                <input type="text" class="form-control" id="img_url" name="img_url" required>
            </div>
            <div class="form-group">
                <label for="country">País:</label>
                <input type="text" class="form-control" id="country" name="country" required>
            </div>
            <div class="form-group">
                <label for="duration">Duración (minutos):</label>
                <input type="number" class="form-control" id="duration" name="duration" required>
            </div>
            <button type="submit" class="btn btn-primary">Agregar Película</button>
        </form>
    </div>

    <br>

    <h1 class="mt-4 h1-toggle">LISTAR PELICULAS</h1>
    <div class="collapsible-content">
        <ul>
            <li><a href="/filmout/oldFilms">Pelis antiguas</a></li>
            <li><a href="/filmout/newFilms">Pelis nuevas</a></li>
            <li><a href="/filmout/films">Pelis</a></li>
            <li><a href="/filmout/filmsOrderedByGenre">Películas ordenadas por género</a></li>
            <li><a href="/filmout/filmsOrderedByYear">Películas ordenadas por año</a></li>
            <li><a href="{{ route('countFilms') }}">Contar películas</a></li>
        </ul>
    </div>
@endsection
