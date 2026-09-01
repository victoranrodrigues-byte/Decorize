<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('modelos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('ambiente_id')
                ->constrained('ambientes')
                ->cascadeOnDelete();

            $table->string('nome');
            $table->string('tipo');
            $table->string('origem');
            $table->string('estilo')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('modelos');
    }
};
