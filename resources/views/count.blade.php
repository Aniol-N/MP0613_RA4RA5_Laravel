<h1>{{ $title }}</h1>
@if ($count)
    <h2>Hay {{ $count }} peliculas.</h2>
@else
    <h2>ERROR: No se han encontrado peliculas.</h2>
@endif
