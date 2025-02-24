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
        Schema::create('api_registro_consultas', function (Blueprint $table) {
            $table->collation('utf8mb4_spanish_ci');
            $table->id('id_registro');

            $table->bigInteger('id_paciente')->unsigned()->nullable(false);
            $table->foreign('id_paciente')->references('id_dato_paciente')->on('api_datos_pacientes');

            $table->integer('no_consulta_paciente')->index()->nullable(false);
            $table->string('motivo_consulta', 500);
            $table->json('sintoma_gastro')->nullable();
            $table->enum('escala_bristol', ['Tipo 1', 'Tipo 2', 'Tipo 3', 'Tipo 4', 'Tipo 5', 'Tipo 6', 'Tipo 7'])->nullable();
            $table->string('apego_plan_anterior_barr_apego', 250)->nullable(false);
            $table->enum('motivacion', ['Nada motivado', 'Poco motivado', 'Neutral', 'Motivado', 'Muy motivado']);
            $table->json('hidratacion')->nullable(false);
            $table->string('sintomas_generales', 500)->nullable(false);
            $table->json('dinamometria')->nullable();
            $table->integer('consulta_actual')->nullable(false);
            $table->tinyText('nutri_elaborate_data');
            $table->tinyText('nutri_who_approved_data');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('api_registro_consultas');
    }
};
