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
        Schema::create('api_dieteticos_instrumento_medicion', function (Blueprint $table) {
            $table->collation('utf8mb4_spanish_ci');
            $table->id('id_dietetico_instru');
            $table->bigInteger('id_consulta_paciente')->unsigned()->nullable(false);
            $table->foreign('id_consulta_paciente')->references('id_registro')->on('api_registro_consultas')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->enum('tipo_instrumento', ['Recorda 24/h', 'Dieta habitual semicuantitativa', 'Diario de alimentos']);
            $table->time('desayuno_hora');
            $table->string('colacion1', 70)->nullable(false);
            $table->time('comida_hora');
            $table->string('colacion2', 70)->nullable(false);
            $table->time('cena_hora');
            $table->string('colacion3', 70)->nullable(false);
            $table->json('grupo_total_eq');
            $table->decimal('total_kcal', 10, 2)->nullable(false);
            $table->decimal('total_prot_por', 10, 2)->nullable(false);
            $table->decimal('total_prot_g', 10, 2)->nullable(false);
            $table->decimal('total_lip', 10, 2)->nullable(false);
            $table->decimal('total_lip_g', 10, 2)->nullable(false);
            $table->decimal('total_hco', 10, 2)->nullable(false);
            $table->decimal('total_hco_g', 10, 2)->nullable(false);
            $table->decimal('adecuacion_porcen_ener_kcal', 10, 2)->nullable(false);
            $table->decimal('adecuacion_porcen_ene_porcen', 10, 2)->nullable(false);
            $table->decimal('adecuacion_porcen_prot', 10, 2)->nullable(false);
            $table->decimal('adecuacion_porcen_lip', 10, 2)->nullable(false);
            $table->decimal('adecuacion_porcen_hco', 10, 2)->nullable(false);
            $table->string('aspectos_cualita_dieta_habitual', 150)->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('api_dieteticos_instrumento_medicion');
    }
};
