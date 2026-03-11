@extends('layouts.master')

@section('header')
    <div class="container py-2 d-flex justify-content-between align-items-center">
        <div>
            <span class="nav-home selected">SEARCH</span>
        </div>
    </div>
@endsection

@section('content')
    <h1>Buscar actores por criterio</h1>
    
    <div class="search-form">
        <form action="{{ route('actorsByDecade') }}" method="get">
            <div class="form-group">
                <label for="decade">Década nacimiento</label>
                <select class="form-control" id="decade" name="decade" required>
                    <option value="">Seleccionar década</option>
                    <option value="1980">1980-1989</option>
                    <option value="1990">1990-1999</option>
                    <option value="2000">2000-2009</option>
                    <option value="2010">2010-2019</option>
                    <option value="2020">2020-2029</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Buscar</button>
        </form>
    </div>
@endsection
