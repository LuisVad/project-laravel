<!-- resources/views/usuarios/ver.blade.php -->
@extends('layouts.layout')

@section('title', 'Ver Usuario')

@section('content')
    <!-- Button to trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#userModal">
        Ver Usuario
    </button>

    <!-- Modal -->
    <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userModalLabel">Detalles del Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul class="list-group">
                        <li class="list-group-item"><strong>Nombre:</strong> {{ $usuario->nombre }}</li>
                        <li class="list-group-item"><strong>Apellido Paterno:</strong> {{ $usuario->apellido_paterno }}</li>
                        <li class="list-group-item"><strong>Apellido Materno:</strong> {{ $usuario->apellido_materno }}</li>
                        <li class="list-group-item"><strong>Correo:</strong> {{ $usuario->correo }}</li>
                        <li class="list-group-item"><strong>Fecha de Nacimiento:</strong> {{ $usuario->fecha_nacimiento }}</li>
                        <li class="list-group-item"><strong>Ciudad:</strong> {{ $usuario->ciudad }}</li>
                        <li class="list-group-item"><strong>Estado:</strong> {{ $usuario->estado }}</li>
                        <li class="list-group-item"><strong>Nacionalidad:</strong> {{ $usuario->nacionalidad }}</li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
@endsection
