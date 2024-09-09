<!-- resources/views/usuarios.blade.php -->
@extends('layouts.layout')

@section('title', 'Usuarios')

@section('content')
    <h1 class="mb-4">Usuarios</h1>
    <a href="{{ route('usuarios.create') }}" class="btn btn-primary mb-3">Agregar Usuario</a>

    @if($usuarios->isEmpty())
        <p>No hay usuarios registrados.</p>
    @else
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido Paterno</th>
                    <th>Apellido Materno</th>
                    <th>Correo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->id }}</td>
                    <td>{{ $usuario->nombre }}</td>
                    <td>{{ $usuario->apellido_paterno }}</td>
                    <td>{{ $usuario->apellido_materno }}</td>
                    <td>{{ $usuario->correo }}</td>
                    <td class="table-actions">
                        <a data-id="{{ $usuario->id }}" class="btn btn-info btn-sm view-btn">Ver</a>
                        <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este usuario?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    
    <!-- Modal -->
    <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">Detalles del Usuario</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Detalles del usuario se cargarán aquí -->
                    <div id="modal-content">
                        <!-- Carga de datos con JavaScript -->
                    </div>
                </div>
                <div class="modal-footer">
                    <a type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const viewBtns = document.querySelectorAll('.view-btn');

        viewBtns.forEach(button => {
            button.addEventListener('click', function () {
                const userId = this.getAttribute('data-id');

                fetch(`/usuarios/${userId}`)
                    .then(response => response.json())
                    .then(data => {
                        // Formatear la fecha
                        const formattedDate = formatDate(data.fecha_nacimiento);
                        
                        document.getElementById('modal-content').innerHTML = `
                            <ul class="list-group">
                                <li class="list-group-item"><strong>Nombre:</strong> ${data.nombre}</li>
                                <li class="list-group-item"><strong>Apellido Paterno:</strong> ${data.apellido_paterno}</li>
                                <li class="list-group-item"><strong>Apellido Materno:</strong> ${data.apellido_materno}</li>
                                <li class="list-group-item"><strong>Correo:</strong> ${data.correo}</li>
                                <li class="list-group-item"><strong>Fecha de Nacimiento:</strong> ${formattedDate}</li>
                                <li class="list-group-item"><strong>Ciudad:</strong> ${data.ciudad}</li>
                                <li class="list-group-item"><strong>Estado:</strong> ${data.estado}</li>
                                <li class="list-group-item"><strong>Nacionalidad:</strong> ${data.nacionalidad}</li>
                            </ul>
                        `;
                        // Show the modal
                        new bootstrap.Modal(document.getElementById('viewModal')).show();
                    });
            });
        });

        // Función para formatear la fecha
        function formatDate(dateString) {
            const [year, month, day] = dateString.split('-');
            const date = new Date(year, month - 1, day); // Los meses en JavaScript empiezan desde 0
            const options = { year: 'numeric', month: 'long', day: 'numeric' };
            return date.toLocaleDateString('es-ES', options);
        }
    });
</script>
@endsection

