<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('item_modelos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('modelo_id')
                ->constrained('modelos')
                ->cascadeOnDelete();

            $table->foreignId('mobilia_id')
                ->constrained('mobilias')
                ->cascadeOnDelete();

            $table->decimal('posicao_x', 10, 2)->default(0);
            $table->decimal('posicao_y', 10, 2)->default(0);
            $table->decimal('posicao_z', 10, 2)->default(0);

            $table->decimal('rotacao', 10, 2)->default(0);
            $table->decimal('escala', 10, 2)->default(1);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('item_modelos');
    }
};
