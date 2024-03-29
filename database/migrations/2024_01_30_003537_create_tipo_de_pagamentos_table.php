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
        Schema::create('tipo_de_pagamentos', function (Blueprint $table) {
            $table->id();
            $table->string('nome',)->nullable(false);
            $table->string('taxa', 4)->nullable(false);
            $table->string('status', 15)->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipo_de_pagamentos');
    }
};
