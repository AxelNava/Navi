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
        Schema::create('api_datos_nutriologos', function (Blueprint $table) {
            $table->collation('utf8mb4_spanish_ci');
            $table->id('id_nutriologo')->primary();
            $table->bigInteger('id_persona')->unsigned()->nullable(false);
            $table->foreign('id_persona')->references('persona_id')
                ->on('api_personas')->onDelete('cascade')->onUpdate('cascade');
            $table->json('datos_alumno');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('api_datos_nutriologos');
    }
};
