<!-- resources/views/usuarios.blade.php -->
@extends('layouts.layout')

@section('title', 'Usuarios')

@section('content')
    <h1 class="mb-4">Usuarios</h1>
    <a data-url="{{ route('usuarios.create') }}" id="addUserBtn" class="btn btn-primary mb-3">Agregar Usuario</a>

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
                        <a data-url="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-warning btn-sm editUserBtn">Editar</a>
                        <a type="button" class="btn btn-danger btn-sm delete-btn" data-id="{{ $usuario->id }}">Eliminar</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    
    <!-- Modal de carga -->
	<div class="modal fade" id="loadingModal" tabindex="-1" aria-hidden="true">
    	<div class="modal-dialog modal-dialog-centered">
        	<div class="modal-content">
            	<div class="modal-body text-center">
                	<!-- Spinner 1 -->
                	<div class="spinner-grow text-success" role="status">
                    	<span class="visually-hidden">Loading...</span>
                	</div>
                	<!-- Spinner 2 -->
                	<div class="spinner-grow text-success" role="status">
                    	<span class="visually-hidden">Loading...</span>
                	</div>
                	<!-- Spinner 3 -->
                	<div class="spinner-grow text-success" role="status">
                    	<span class="visually-hidden">Loading...</span>
                	</div>
                	<!-- Spinner 4 -->
                	<div class="spinner-grow text-success" role="status">
                    	<span class="visually-hidden">Loading...</span>
                	</div>
                	<!-- Spinner 5 -->
                	<div class="spinner-grow text-success" role="status">
                    	<span class="visually-hidden">Loading...</span>
                	</div>
                	<!-- Spinner 6 -->
                	<div class="spinner-grow text-success" role="status">
                    	<span class="visually-hidden">Loading...</span>
                	</div>
                	<p class="mt-3">Cargando...</p>
            	</div>
        	</div>
    	</div>
	</div>
    
    <!-- Modal para ver el usuario -->
    <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
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
    
    <!-- Modal de Confirmación de Eliminación -->
	<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    	<div class="modal-dialog modal-dialog-centered" role="document">
        	<div class="modal-content">
            	<div class="modal-header">
                	<h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar Eliminación</h5>
                	<button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            	</div>
            	<div class="modal-body text-center">
                	<i class="fas fa-info-circle fa-3x text-info mb-3"></i>
                	<p>¿Estás seguro de que deseas eliminar este usuario?</p>
            	</div>
            	<div class="modal-footer">
                	<button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
                	<button type="button" id="confirmDeleteBtn" class="btn btn-danger">
                    	Eliminar
                	</button>
            	</div>
        	</div>
    	</div>
	</div>
	
	<!-- Modal de Éxito -->
	<div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
    	<div class="modal-dialog modal-dialog-centered" role="document">
        	<div class="modal-content">
            	<div class="modal-header">
                	<h5 class="modal-title" id="successModalLabel">Éxito</h5>
                	<button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            	</div>
            	<div class="modal-body text-center">
                	<i class="fas fa-check-circle fa-3x text-success mb-3"></i>
                	<p>¡El usuario ha sido eliminado correctamente!</p>
            	</div>
            	<div class="modal-footer">
                	<a href="{{ route('usuarios.index') }}" class="btn btn-success">Aceptar</a>
            	</div>
        	</div>
    	</div>
	</div>
	
	<!-- Modal de Error -->
	<div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
    	<div class="modal-dialog modal-dialog-centered" role="document">
        	<div class="modal-content">
            	<div class="modal-header">
                	<h5 class="modal-title" id="errorModalLabel">Error</h5>
                	<button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            	</div>
            	<div class="modal-body text-center">
                	<i class="fas fa-times-circle fa-3x text-danger mb-3"></i>
                	<p>Error al eliminar el usuario. Inténtalo de nuevo.</p>
            	</div>
            	<div class="modal-footer">
                	<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            	</div>
        	</div>
    	</div>
	</div>
@endsection

@section('scripts')
<script>

	document.addEventListener('DOMContentLoaded', function () {
    	const loadingModal = new bootstrap.Modal(document.getElementById('loadingModal'), {
        	backdrop: 'static', // Evita que se cierre el modal haciendo clic fuera
        	keyboard: false // Evita que se cierre el modal con la tecla Esc
    	});
	
    	// Mostrar el modal de carga cuando la página se recarga
    	loadingModal.show();
	
    	// Esperar a que la página se haya cargado completamente
    	window.onload = function() {
        	// Mantener el modal visible durante 3 segundos antes de ocultarlo
        	setTimeout(function () {
            	loadingModal.hide();
        	}, 3000); // 3 segundos de espera
    	};
	});
		
	document.addEventListener('DOMContentLoaded', function () {
    	// Restablecer el estado de los botones cuando la página es cargada nuevamente al regresar
    	window.addEventListener('pageshow', function (event) {
        	// Restablecer el contenido del botón "Agregar Usuario"
        	const addUserBtn = document.getElementById('addUserBtn');
        	if (addUserBtn) {
            	addUserBtn.innerHTML = 'Agregar Usuario';
            	addUserBtn.removeAttribute('disabled');
        	}
	
        	// Restablecer el contenido de todos los botones "Editar Usuario"
        	const editUserBtns = document.querySelectorAll('.editUserBtn');
        	editUserBtns.forEach(button => {
            	button.innerHTML = 'Editar';
            	button.removeAttribute('disabled');
        	});
    	});
	
    	// Agregar el spinner al botón "Agregar Usuario"
    	const addUserBtn = document.getElementById('addUserBtn');
    	if (addUserBtn) {
        	addUserBtn.addEventListener('click', function (e) {
            	e.preventDefault(); // Prevenir la redirección inmediata
            	
				const url = this.getAttribute('data-url');
            	// Mostrar el spinner en el botón
            	addUserBtn.innerHTML = `
                	<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                	Cargando...
            	`;
            	addUserBtn.setAttribute('disabled', true);
	
            	// Esperar 3 segundos antes de redirigir a la página de creación de usuarios
            	setTimeout(function () {
                	window.location.href = url;
            	}, 3000); // 3 segundos de espera
        	});
    	}
	
    	// Agregar el spinner a los botones "Editar Usuario"
    	const editUserBtns = document.querySelectorAll('.editUserBtn');
    	editUserBtns.forEach(button => {
        	button.addEventListener('click', function (e) {
            	e.preventDefault(); // Prevenir la redirección inmediata
	
            	const url = this.getAttribute('data-url');
            	// Mostrar el spinner en el botón
            	this.innerHTML = `
                	<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            	`;
            	this.setAttribute('disabled', true);
	
            	// Esperar 3 segundos antes de redirigir a la página de edición
            	setTimeout(function () {
                	window.location.href = url;
            	}, 3000); // 3 segundos de espera
        	});
    	});
	});

	
    document.addEventListener('DOMContentLoaded', function () {
        const viewBtns = document.querySelectorAll('.view-btn');

        viewBtns.forEach(button => {
            button.addEventListener('click', function () {
                const userId = this.getAttribute('data-id');
                const buttonElement = this;

                // Cambiar el contenido del botón para mostrar el spinner
                buttonElement.innerHTML = `
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                `;
                buttonElement.setAttribute('disabled', true); // Deshabilitar el botón mientras carga

                // Simular la carga con un temporizador de 5 segundos
                setTimeout(function () {
                    // Cargar los datos del usuario
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

                            // Mostrar el modal
                            new bootstrap.Modal(document.getElementById('viewModal')).show();

                            // Restaurar el botón a su estado original
                            buttonElement.innerHTML = 'Ver';
                            buttonElement.removeAttribute('disabled');
                        });
                }, 3000); // Tiempo de espera de 3 segundos
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
    
    document.addEventListener('DOMContentLoaded', function () {
    	let userIdToDelete = null;
	
    	const confirmDeleteModal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
    	const successModal = new bootstrap.Modal(document.getElementById('successModal'));
    	const errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
	
    	document.querySelectorAll('.delete-btn').forEach(button => {
        	button.addEventListener('click', function () {
            	userIdToDelete = this.getAttribute('data-id'); // Obtener el id del usuario
            	confirmDeleteModal.show();
        	});
    	});
	
    	// Confirmar eliminación y mostrar spinner
    	document.getElementById('confirmDeleteBtn').addEventListener('click', function () {
        	const deleteBtn = this;
        	deleteBtn.innerHTML = 
            	'<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
        	;
        	deleteBtn.setAttribute('disabled', true); // Desactivar el botón
	
        	// Realizar la solicitud AJAX para eliminar el usuario
        	fetch(`/usuarios/${userIdToDelete}`, {
            	method: 'DELETE',
            	headers: {
                	'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                	'Content-Type': 'application/json'
            	}
        	})
        	.then(response => {
            	return response.json(); // Parsear la respuesta JSON
        	})
        	.then(data => {
	
            	// Ocultar el modal de confirmación
            	confirmDeleteModal.hide(); 
            	deleteBtn.removeAttribute('disabled'); // Reactivar el botón
            	deleteBtn.innerHTML = 'Eliminar'; // Restaurar el texto original del botón
	
            	if (data.message === 'Usuario eliminado con éxito.') {
                	successModal.show(); // Mostrar modal de éxito
            	} else {
                	throw new Error(data.message || 'Error al eliminar el usuario');
            	}
        	})
        	.catch(error => {
            	confirmDeleteModal.hide(); // Ocultar el modal de confirmación
            	deleteBtn.removeAttribute('disabled'); // Reactivar el botón
            	deleteBtn.innerHTML = 'Eliminar'; // Restaurar el texto original del botón
            	errorModal.show(); // Mostrar modal de error
        	});
    	});
	});
</script>
@endsection

