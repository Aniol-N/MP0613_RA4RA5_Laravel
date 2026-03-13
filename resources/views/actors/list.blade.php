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
                        <th>Acciones</th>
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
                            <td>
                                <button type="button" class="btn btn-danger btn-sm js-open-delete-modal"
                                        data-toggle="modal"
                                        data-target="#confirmDelete"
                                        data-id="{{ $actor['id'] }}"
                                        data-name="{{ $actor['name'] }}">
                                    Eliminar
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Modal de confirmación de borrado -->
        <div class="modal fade" id="confirmDelete" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmDeleteLabel">Confirmar eliminación</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        ¿Estás seguro de que quieres eliminar a <strong id="actorName"></strong>?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <form id="deleteForm" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var modal = document.getElementById('confirmDelete');
                var actorName = document.getElementById('actorName');
                var deleteForm = document.getElementById('deleteForm');
                var buttons = document.querySelectorAll('.js-open-delete-modal');

                // Move modal out of main container to avoid z-index/stacking issues.
                if (modal && modal.parentNode !== document.body) {
                    document.body.appendChild(modal);
                }

                buttons.forEach(function(button) {
                    button.addEventListener('click', function() {
                        actorName.textContent = this.getAttribute('data-name') || '';
                        deleteForm.action = '{{ url("actorout/actor") }}/' + this.getAttribute('data-id');
                    });
                });
            });
        </script>
    @endif
@endsection
