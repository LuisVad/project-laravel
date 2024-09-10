<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsuarioController extends Controller
{
    // Mostrar una lista de usuarios
    public function index()
    {
        $usuarios = Usuario::all();
        //dd($usuarios);
        return view('usuarios', compact('usuarios')); // Devolver la vista con los usuarios
    }

    // Mostrar el formulario para crear un nuevo usuario
    public function create()
    {
        return view('crear'); // Devolver la vista para crear un usuario
    }

    // Almacenar un nuevo usuario en la base de datos
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'apellido_materno' => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'ciudad' => 'required|string|max:255',
            'estado' => 'required|string|max:255',
            'nacionalidad' => 'required|string|max:255',
            'correo' => 'required|string|email|max:255|unique:usuarios',
            'contraseña' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $usuario = Usuario::create([
            'nombre' => $request->nombre,
            'apellido_materno' => $request->apellido_materno,
            'apellido_paterno' => $request->apellido_paterno,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'ciudad' => $request->ciudad,
            'estado' => $request->estado,
            'nacionalidad' => $request->nacionalidad,
            'correo' => $request->correo,
            'contraseña' => Hash::make($request->contraseña), // Encriptar la contraseña
        ]);

        return redirect()->route('usuarios.index')->with('success', 'Usuario creado con éxito.');
    }

    // Mostrar el usuario especificado
	public function show($id)
	{
    	$usuario = Usuario::find($id);
    	if ($usuario) {
        	return response()->json($usuario);
    	}
    	return response()->json(['message' => 'Usuario no encontrado'], 404);
	}


    // Mostrar el formulario para editar un usuario
    public function edit($id)
    {
        $usuario = Usuario::find($id);
        if ($usuario) {
            return view('editar', compact('usuario'));
        }
        return redirect()->route('usuarios.index')->with('error', 'Usuario no encontrado.');
    }

    // Actualizar el usuario especificado en la base de datos
    public function update(Request $request, $id)
	{
    	$validator = Validator::make($request->all(), [
        	'nombre' => 'sometimes|required|string|max:255',
        	'apellido_materno' => 'sometimes|required|string|max:255',
        	'apellido_paterno' => 'sometimes|required|string|max:255',
        	'fecha_nacimiento' => 'sometimes|required|date',
        	'ciudad' => 'sometimes|required|string|max:255',
        	'estado' => 'sometimes|required|string|max:255',
        	'nacionalidad' => 'sometimes|required|string|max:255',
        	'correo' => 'sometimes|required|string|email|max:255|unique:usuarios,correo,' . $id,
        	'contraseña' => 'nullable|string|min:8',
    	]);
	
    	if ($validator->fails()) {
        	return response()->json($validator->errors(), 422);
    	}
	
    	$usuario = Usuario::find($id);
    	if (!$usuario) {
        	return response()->json(['message' => 'Usuario no encontrado'], 404);
    	}
	
    	$usuario->update([
        	'nombre' => $request->nombre ?? $usuario->nombre,
        	'apellido_materno' => $request->apellido_materno ?? $usuario->apellido_materno,
        	'apellido_paterno' => $request->apellido_paterno ?? $usuario->apellido_paterno,
        	'fecha_nacimiento' => $request->fecha_nacimiento ?? $usuario->fecha_nacimiento,
        	'ciudad' => $request->ciudad ?? $usuario->ciudad,
        	'estado' => $request->estado ?? $usuario->estado,
        	'nacionalidad' => $request->nacionalidad ?? $usuario->nacionalidad,
        	'correo' => $request->correo ?? $usuario->correo,
        	'contraseña' => $request->contraseña ? Hash::make($request->contraseña) : $usuario->contraseña,
    	]);
    	
	
    	return response()->json(['status' => 'success']);
	}
	

    // Eliminar el usuario especificado de la base de datos
    public function destroy($id)
	{
    	$usuario = Usuario::find($id);
    	if (!$usuario) {
        	return response()->json(['message' => 'Usuario no encontrado.'], 404);
    	}
	
    	$usuario->delete();
    	return response()->json(['message' => 'Usuario eliminado con éxito.'], 200);
	}
}
