@extends('layouts.master')

@section('header')
    <div class="container py-2 d-flex justify-content-between align-items-center">
        <div>
            <span class="nav-home selected">Contar actores</span>
        </div>
    </div>
@endsection

@section('content')
    <h1>{{ $title }}</h1>
    @if ($count)
        <h2>Hay {{ $count }} actores.</h2>
    @else
        <h2>ERROR: No se han encontrado actores.</h2>
    @endif
@endsection