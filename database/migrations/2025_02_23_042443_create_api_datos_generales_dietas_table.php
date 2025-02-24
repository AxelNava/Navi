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
        Schema::create('api_datos_generales_dietas', function (Blueprint $table) {
            $table->collation('utf8mb4_spanish_ci');
            $table->id('id_dieta');
            $table->bigInteger('id_consulta_paciente')->unsigned()->nullable(false);
            $table->foreign('id_consulta_paciente')->references('id_registro')->on('api_registro_consultas')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->string('objetivo_dieta', 100)->nullable();
            $table->string('tipo_dieta', 40)->nullable();
            $table->decimal('kcal_dieta', 10, 2)->nullable(false);
            $table->decimal('prot_porcent_dieta', 10, 2)->nullable(false);
            $table->decimal('prot_kg_dia_dieta', 10, 2)->nullable(false);
            $table->decimal('lip_porcen_dieta', 10, 2)->nullable(false);
            $table->decimal('lip_g_dieta', 10, 2)->nullable(false);
            $table->decimal('hco_porcen_dieta', 10, 2)->nullable(false);
            $table->decimal('hco_g_dieta', 10, 2)->nullable(false);
            $table->string('suplementos', 150)->nullable(false);
            $table->string('metas_smart', '200')->nullable(false);
            $table->json('param_meta')->nullable();
            $table->string('educacion', 100)->nullable();
            $table->string('monitoreo', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('api_datos_generales_dietas');
    }
};
