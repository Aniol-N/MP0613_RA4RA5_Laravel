@extends('layouts.master')

@section('header')
    <div class="container py-2 d-flex justify-content-between align-items-center">
        <div>
            <span class="nav-home selected">LIST</span>
        </div>
    </div>
@endsection

@section('content')
    <h1>{{ $title }}</h1>

    @if(empty($films))
        <div class="text-danger">No se ha encontrado ninguna película</div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        @foreach(array_keys($films[0]) as $key)
                            <th>{{ $key }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($films as $film)
                        <tr>
                            <td>{{ $film['name'] }}</td>
                            <td>{{ $film['year'] }}</td>
                            <td>{{ $film['genre'] }}</td>
                            <td><img src="{{ $film['img_url'] }}" alt="{{ $film['name'] }}" style="width:100px;height:120px;object-fit:cover;" /></td>
                            <td>{{ $film['country'] }}</td>
                            <td>{{ $film['duration'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection