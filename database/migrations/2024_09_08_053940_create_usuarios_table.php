<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id(); // Campo id (auto-incremental)
            $table->string('nombre'); // Nombre(s)
            $table->string('apellido_materno'); // Apellido materno
            $table->string('apellido_paterno'); // Apellido paterno
            $table->date('fecha_nacimiento'); // Fecha de nacimiento
            $table->string('ciudad'); // Ciudad
            $table->string('estado'); // Estado
            $table->string('nacionalidad'); // Nacionalidad
            $table->string('correo')->unique(); // Correo (debe ser único)
            $table->string('contraseña'); // Contraseña (encriptada)
            $table->timestamps(); // Campos created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
}

