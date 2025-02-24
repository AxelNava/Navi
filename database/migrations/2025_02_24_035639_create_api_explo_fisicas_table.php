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
        Schema::create('api_explo_fisica', function (Blueprint $table) {
            $table->collation('utf8mb4_spanish_ci');
            $table->id('id_explo');
            $table->bigInteger('id_consulta_paciente')->unsigned()->nullable(false);
            $table->foreign('id_consulta_paciente')->references('id_registro')->on('api_registro_consultas')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->string('pelo_unias', 100)->nullable();
            $table->string('piel', 100)->nullable(false);
            $table->string('ojos', 100)->nullable(false);
            $table->string('musculo', 100)->nullable(false);
            $table->string('otros', 200)->nullable();
            $table->string('intolerancia_alimentos', 200)->nullable(false);
            $table->tinyText('actividad_fis_actual')->nullable();
            $table->string('cambios_pos_estilo_vida', 300)->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('api_explo_fisica');
    }
};
