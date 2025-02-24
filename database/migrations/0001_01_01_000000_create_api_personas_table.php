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
        Schema::create('api_personas', function (Blueprint $table) {
            $table->collation('utf8mb4_spanish_ci');
            $table->id('persona_id');
            $table->string('nombre', 50);
            $table->tinyInteger('edad', unsigned: true);
            $table->enum('genero', ['M', 'F']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('api_personas');
    }
};
