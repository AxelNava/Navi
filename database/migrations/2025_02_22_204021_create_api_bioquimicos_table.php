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
        Schema::create('api_bioquimicos', function (Blueprint $table) {
            $table->collation('utf8mb4_spanish_ci');
            $table->id('id_bioquimico')->primary();
            $table->bigInteger('id_consulta_paciente')->unsigned()->nullable(false);
            $table->foreign('id_consulta_paciente')->references('id_registro')->on('api_registro_consultas')->onDelete('cascade');
            $table->decimal('glucosa', 10, 2)->nullable();
            $table->tinyInteger('hbAc1')->nullable();
            $table->decimal('TG', 10, 2)->nullable(false);
            $table->decimal('CT', 10, 2)->nullable(false);
            $table->decimal('HDL', 10, 2)->nullable(false);
            $table->decimal('LDL', 10, 2)->nullable(false);
            $table->tinyInteger('AST_perc')->nullable(false);
            $table->decimal('ALT', 10, 2)->nullable(false);
            $table->decimal('THS', 10, 2)->nullable(false);
            $table->decimal('T3', 10, 2)->nullable(false);
            $table->decimal('T4', 10, 2)->nullable(false);
            $table->decimal('Hb', 10, 2)->nullable(false);
            $table->decimal('hierro', 10, 2)->nullable(false);
            $table->decimal('transferrina', 10, 2)->nullable(false);
            $table->decimal('t3_libre', 10, 2)->nullable(false);
            $table->decimal('t4_libre', 10, 2)->nullable(false);
            $table->tinyInteger('hto')->nullable(false);
            $table->decimal('B12', 10, 2)->nullable(false);
            $table->decimal('folatos', 10, 2)->nullable(false);
            $table->decimal('PT', 10, 2)->nullable(false);
            $table->decimal('albumina', 10, 2)->nullable(false);
            $table->decimal('Ca', 10, 2)->nullable(false);
            $table->string('otros', 70)->nullable(false);
            $table->string('clinicos', 150)->nullable(false);
            $table->tinyText('dinamometria')->nullable(false);
            $table->string('medicamentos_suplementos', 150)->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('api_bioquimicos');
    }
};
