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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('correo')->unique();
            // $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

            $table->date('fecha_inicio');
            $table->string('tipo');
            $table->bigInteger('ci');
            $table->string('apellido');
            $table->string('direccion');
            $table->bigInteger('telefono');
            $table->float('salario');
            $table->unsignedBigInteger('farmacia_id');
            $table->string('imagen');

            $table->foreign('farmacia_id')->references('id')->on('farmacias')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
