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
        Schema::create('api_dieteticos_frecuencia_semanal', function (Blueprint $table) {
            $table->collation('utf8mb4_spanish_ci');
            $table->id('id_dietetico');
            $table->bigInteger('id_consulta_paciente')->unsigned()->nullable(false);
            $table->foreign('id_consulta_paciente')->references('id_registro')->on('api_registro_consultas')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->tinyInteger('frutas')->nullable(false);
            $table->tinyInteger('verduras')->nullable(false);
            $table->tinyInteger('cereales_s_g')->nullable(false);
            $table->tinyInteger('cereales_c_g')->nullable(false);
            $table->tinyInteger('leguminosas')->nullable(false);
            $table->tinyInteger('poa')->nullable(false);
            $table->tinyInteger('lacteos')->nullable(false);
            $table->tinyInteger('aceites_s_p')->nullable(false);
            $table->tinyInteger('aceites_c_p')->nullable(false);
            $table->tinyInteger('azucares')->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('api_dieteticos_frecuencia_semanal');
    }
};
