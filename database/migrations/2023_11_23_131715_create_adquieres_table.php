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
        Schema::create('adquieres', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->float('montototal');
            $table->date('fecha');
            $table->unsignedBigInteger('proveedor_id');
            $table->unsignedBigInteger('user_id');

            $table->foreign('proveedor_id')->references('id')->on('proveedors')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adquieres');
    }
};
