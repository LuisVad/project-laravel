<!-- resources/views/usuarios/editar.blade.php -->
@extends('layouts.layout')

@section('title', 'Editar Usuario')

@section('content')
    <h1>Editar Usuario</h1>

    <form id="editForm" action="{{ route('usuarios.update', $usuario->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
        	<label for="nombre" class="form-label">Nombre</label>
        	<input type="text" class="form-control" id="nombre" name="nombre" value="{{ $usuario->nombre }}">
        	<div class="invalid-feedback" id="nombreFeedback"></div>
    	</div>
    	<div class="mb-3">
        	<label for="apellido_paterno" class="form-label">Apellido Paterno</label>
        	<input type="text" class="form-control" id="apellido_paterno" name="apellido_paterno" value="{{ $usuario->apellido_paterno }}">
        	<div class="invalid-feedback" id="apellidoPaternoFeedback"></div>
    	</div>
    	<div class="mb-3">
        	<label for="apellido_materno" class="form-label">Apellido Materno</label>
        	<input type="text" class="form-control" id="apellido_materno" name="apellido_materno" value="{{ $usuario->apellido_materno }}">
        	<div class="invalid-feedback" id="apellidoMaternoFeedback"></div>
    	</div>
    	<div class="mb-3">
        	<label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
        	<input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ $usuario->fecha_nacimiento }}">
        	<div class="invalid-feedback" id="fechaNacimientoFeedback"></div>
    	</div>
    	<div class="mb-3">
        	<label for="ciudad" class="form-label">Ciudad</label>
        	<input type="text" class="form-control" id="ciudad" name="ciudad" value="{{ $usuario->ciudad }}">
        	<div class="invalid-feedback" id="ciudadFeedback"></div>
    	</div>
    	<div class="mb-3">
        	<label for="estado" class="form-label">Estado</label>
        	<input type="text" class="form-control" id="estado" name="estado" value="{{ $usuario->estado }}">
        	<div class="invalid-feedback" id="estadoFeedback"></div>
    	</div>
    	<div class="mb-3">
        	<label for="nacionalidad" class="form-label">Nacionalidad</label>
        	<input type="text" class="form-control" id="nacionalidad" name="nacionalidad" value="{{ $usuario->nacionalidad }}">
        	<div class="invalid-feedback" id="nacionalidadFeedback"></div>
    	</div>
    	<div class="mb-3">
        	<label for="correo" class="form-label">Correo Electrónico</label>
        	<input type="email" class="form-control" id="correo" name="correo" value="{{ $usuario->correo }}">
        	<div class="invalid-feedback" id="correoFeedback"></div>
    	</div>
    	<div class="mb-3">
        	<label for="contraseña" class="form-label">Contraseña</label>
        	<input type="password" class="form-control" id="contraseña" name="contraseña">
        	<small class="form-text text-muted">Deja este campo vacío si no deseas cambiar la contraseña.</small>
        	<div class="invalid-feedback" id="contraseñaFeedback"></div>
    	</div>
        <button type="submit" class="btn btn-success">Guardar Cambios</button>
        <a href="{{ url('/usuarios') }}" class="btn btn-primary">Volver</a>
    </form>

    <!-- Modal de Éxito -->
	<div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
    	<div class="modal-dialog" role="document">
        	<div class="modal-content">
            	<div class="modal-header">
                	<h5 class="modal-title" id="successModalLabel">Éxito</h5>
                	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    	<span aria-hidden="true">&times;</span>
                	</button>
            	</div>
            	<div class="modal-body text-center">
                	<i class="fas fa-check-circle fa-3x text-success mb-3"></i>
                	<p>¡El usuario se ha actualizado correctamente!</p>
            	</div>
            	<div class="modal-footer">
                	<a href="{{ route('usuarios.index') }}" class="btn btn-success">Aceptar</a>
            	</div>
        	</div>
    	</div>
	</div>
	
	<!-- Modal de Advertencia -->
	<div class="modal fade" id="warningModal" tabindex="-1" role="dialog" aria-labelledby="warningModalLabel" aria-hidden="true">
    	<div class="modal-dialog" role="document">
        	<div class="modal-content">
            	<div class="modal-header">
                	<h5 class="modal-title" id="warningModalLabel">Advertencia</h5>
                	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    	<span aria-hidden="true">&times;</span>
                	</button>
            	</div>
            	<div class="modal-body text-center">
                	<i class="fas fa-exclamation-triangle fa-3x text-warning mb-3"></i>
                	<p>Por favor, completa todos los campos obligatorios antes de guardar.</p>
            	</div>
            	<div class="modal-footer">
                	<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            	</div>
        	</div>
    	</div>
	</div>
@endsection

@section('scripts')
<script>
    	$(document).ready(function() {
    		$('#editForm').on('submit', function(e) {
        		e.preventDefault(); // Prevenir el envío tradicional del formulario
		
        		// Limpiar mensajes de error anteriores y clases de error
        		$('.invalid-feedback').text('').hide(); // Limpiar cualquier mensaje anterior y ocultarlo
        		$('input').removeClass('is-invalid');   // Limpiar la clase de error en todos los inputs
		
        		let formData = $(this).serialize();
		
        		$.ajax({
            		url: $(this).attr('action'),
            		type: 'POST',
            		data: formData,
            		success: function(response) {
            			//console.log("Respuesta del servidor:", response);
            			//console.log("Respuesta del servidor:", response.status);
                		if (response.status === 'success') {
                    		// Mostrar el modal de éxito si la respuesta es exitosa
                    		$('#successModal').modal('show');
                    		startInactivityTimer();
                		}
            		},
            		error: function(xhr) {
                		if (xhr.status === 422) {
                    		// Obtener los errores de validación
                    		let errors = xhr.responseJSON;
                    		//console.log("Errores recibidos:", errors);
		
                    		// Añadir validación para los campos si es necesario
                    		if (errors.nombre) {
                        		//console.log(errors.nombre[0]); // Esto ya funciona correctamente
                        		$('#nombreFeedback').text("Este campo es requerido").show(); // Mostrar el mensaje de error
                        		$('#nombre').addClass('is-invalid'); // Agregar la clase de error al input
                    		}
		
                    		if (errors.apellido_paterno) {
                        		$('#apellidoPaternoFeedback').text("Este campo es requerido").show();
                        		$('#apellido_paterno').addClass('is-invalid');
                    		}
                    		if (errors.apellido_materno) {
                        		$('#apellidoMaternoFeedback').text("Este campo es requerido").show();
                        		$('#apellido_materno').addClass('is-invalid');
                    		}
                    		if (errors.fecha_nacimiento) {
                        		$('#fechaNacimientoFeedback').text(errors.fecha_nacimiento[0]).show();
                        		$('#fecha_nacimiento').addClass('is-invalid');
                    		}
                    		if (errors.ciudad) {
                        		$('#ciudadFeedback').text("Este campo es requerido").show();
                        		$('#ciudad').addClass('is-invalid');
                    		}
                    		if (errors.estado) {
                        		$('#estadoFeedback').text("Este campo es requerido").show();
                        		$('#estado').addClass('is-invalid');
                    		}
                    		if (errors.nacionalidad) {
                        		$('#nacionalidadFeedback').text("Este campo es requerido").show();
                        		$('#nacionalidad').addClass('is-invalid');
                    		}
                    		if (errors.correo) {
                        		$('#correoFeedback').text(errors.correo[0]).show();
                        		$('#correo').addClass('is-invalid');
                    		}
                    		if (errors.contraseña) {
                        		$('#contraseñaFeedback').text(errors.contraseña[0]).show();
                        		$('#contraseña').addClass('is-invalid');
                    		}
		
                    		// Mostrar el modal de advertencia
                    		$('#warningModal').modal('show');
                    		
                		}
            		}
        		});
    		});
		
    		// Escuchar cuando el usuario vuelva a llenar los campos para eliminar los errores
    		$('input').on('input', function() {
        		let inputId = $(this).attr('id');
        		//console.log("Campo modificado:", inputId); // Depuración para verificar el ID del campo
		
        		// Ocultar el mensaje de error y eliminar la clase de error para el campo correspondiente
        		if (inputId) {
            		let feedbackId = '#' + inputId + 'Feedback';
            		//console.log("Feedback ID:", feedbackId); // Depuración para verificar el ID del mensaje de error
		
            		// Solo ocultar si el campo tiene un valor válido
            		if ($(this).val().trim() !== '') {
                		console.log("Si");
                		console.log("Texto antes:", $(feedbackId).text()); // Verifica el texto del mensaje de error antes
                		$(feedbackId).text(''); // Eliminar el texto del mensaje de error
                		$(feedbackId).hide(); // Ocultar el mensaje de error
                		$(this).removeClass('is-invalid'); // Eliminar la clase de error en el input
                		console.log("Texto después:", $(feedbackId).text()); // Verifica el texto del mensaje de error después
            		} 
        		}
    		});
    		
    		// Función para iniciar el temporizador de inactividad
    		function startInactivityTimer() {
        		let time;
        		window.onload = resetTimer;
        		document.onmousemove = resetTimer;
        		document.onkeypress = resetTimer;
		
        		function logout() {
            		window.location.href = '{{ route('usuarios.index') }}';
        		}
		
        		function resetTimer() {
            		clearTimeout(time);
            		time = setTimeout(logout, 15000);  // 15 segundos
        		}
    		}
		
    		// No mostrar ningún modal ni activar el temporizador cuando accedes desde el enlace de editar
    		if (location.search.includes('edit=true')) {
        		console.log("Editing mode - no modals or timers activated.");
        		// Opción: si quieres prevenir la activación de eventos adicionales puedes incluir `return false;`
        		return false;
    		}
    		
		});
    
</script>
@endsection
