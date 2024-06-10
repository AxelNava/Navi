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
        Schema::create('api_comentarios_director', function (Blueprint $table) {
            $table->id();
            $table->tinyText('comentario');
            $table->integer('id_registro');
            $table->foreign('id_registro')->references('id_registro')->on('api_registro_consulta');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('api_comentarios_director');
    }
};
