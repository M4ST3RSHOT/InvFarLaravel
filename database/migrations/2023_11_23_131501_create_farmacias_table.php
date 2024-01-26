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
        Schema::create('farmacias', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('nit');
            $table->string('nombre');
            $table->string('direccion');
            $table->bigInteger('telefono');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('farmacias');
    }
};
