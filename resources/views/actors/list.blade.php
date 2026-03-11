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

    @if(empty($actors))
        <div class="text-danger">No se ha encontrado ningún actor</div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        @foreach(array_keys($actors[0]) as $key)
                            <th>{{ $key }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($actors as $actor)
                        <tr>
                            @foreach($actor as $key => $value)
                                @if($key === 'img_url')
                                    <td><img src="{{ $value }}" alt="{{ $actor['name'] ?? 'actor' }}" style="width:100px;height:120px;object-fit:cover;" /></td>
                                @else
                                    <td>{{ $value }}</td>
                                @endif
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
