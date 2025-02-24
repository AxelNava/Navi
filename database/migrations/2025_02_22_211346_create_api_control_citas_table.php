<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('api_control_citas', function (Blueprint $table) {
            $table->collation('utf8mb4_spanish_ci');
            $table->id('id_cita');
            $table->bigInteger('id_paciente')->unsigned()->nullable(false);
            $table->foreign('id_paciente')->references('id_dato_paciente')->on('api_datos_pacientes')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->bigInteger('id_registro_consulta')->unsigned()->nullable(false);
            $table->foreign('id_registro_consulta')->references('id_registro')->on('api_registro_consultas');

            $table->decimal('peso', 10, 2)->nullable(false);
            $table->decimal('IMC', 10, 2)->nullable(false);
            $table->decimal('masa_grasa_corporal', 10, 2)->nullable(false);
            $table->decimal('porcentaje_grasa_corporal', 10, 2)->nullable(false);
            $table->decimal('masa_muscular_kg', 10, 2)->nullable(false);
            $table->decimal('agua_corpolar', 10, 2)->nullable(false);
            $table->decimal('circunferencia_cintura', 10, 2)->nullable(false);
            $table->decimal('circunferencia_cadera', 10, 2)->nullable(false);
            $table->date('fecha_cita');
            $table->time('hora_cita');
            $table->date('fecha_prox_cita');
            $table->decimal('control_musculo', 10, 2)->nullable(false);
            $table->decimal('control_grasa', 10, 2)->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('api_control_citas');
    }
};
