<?php

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('direccions', function (Blueprint $table) {
            $table->id();
            $table->string('cp', 100)->nullable()->default('text'); // Código Postal
            $table->integer('seccion')->nullable()->default(12); //Sección
            $table->string('colonia', 100)->nullable(); //Colonia
            $table->string('calle', 100)->nullable()->default('Calle'); //Calle
            $table->string('n_exterior', 100)->nullable(); //N* Exterior
            $table->unsignedBigInteger('usuario_id'); 
            $table->foreign('usuario_id')->references('id')->on('usuarios');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('direccions');
    }
};
