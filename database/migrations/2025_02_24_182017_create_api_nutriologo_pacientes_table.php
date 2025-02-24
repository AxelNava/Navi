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
        Schema::create('api_nutriologo_pacientes', function (Blueprint $table) {
            $table->collation('utf8mb4_spanish_ci');
            $table->id();
            $table->bigInteger('id_nutriologo')->unsigned()->nullable(false);
            $table->bigInteger('id_paciente')->unsigned()->nullable(false);

            $table->foreign('id_nutriologo')->references('id_nutriologo')->on('api_datos_nutriologos')
                ->onDelete('cascade');
            $table->foreign('id_paciente')->references('id_dato_paciente')->on('api_datos_pacientes')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('api_nutriologo_pacientes');
    }
};
