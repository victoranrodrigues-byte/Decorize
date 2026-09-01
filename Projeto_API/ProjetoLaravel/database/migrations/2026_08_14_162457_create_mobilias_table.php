<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('mobilias', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('dimensao');
            $table->string('cor');
            $table->string('tipo');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('mobilias');
    }
};
