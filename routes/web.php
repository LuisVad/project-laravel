<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Redirigir la ruta raíz a la vista de usuarios o a la ruta de índice de usuarios
Route::get('/', function () {
    return redirect()->route('usuarios.index');
});

// Rutas para el controlador UsuarioController usando Route::resource
Route::resource('usuarios', UsuarioController::class);

?>
