<?php

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
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();
            $table->string('primer_apellido', 20);
            $table->string('segundo_apellido', 20);
            $table->string('primer_nombre', 20);
            $table->string('otros_nombres', 50)->nullable();
            $table->enum('pais_empleo', ['Colombia', 'Estados Unidos']);
            $table->enum('tipo_identificacion', ['Cédula de Ciudadanía','Cédula de Extranjería','Pasaporte','Permiso Especial']);
            $table->string('numero_identificacion', 20)->unique();
            $table->string('correo', 300)->unique();
            $table->date('fecha_ingreso');
            $table->string('area');
            $table->string('estado')->default('Activo');
            $table->timestamp('fecha_registro')->useCurrent();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};
