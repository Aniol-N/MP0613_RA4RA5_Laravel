@extends('layouts.master')

@section('header')
    <div class="container py-2 d-flex justify-content-between align-items-center">
        <div>
            <span class="nav-home selected">COUNT</span>
        </div>
    </div>
@endsection

@section('content')
    <h1>{{ $title }}</h1>
    @if ($count)
        <h2>Hay {{ $count }} peliculas.</h2>
    @else
        <h2>ERROR: No se han encontrado peliculas.</h2>
    @endif
@endsection
