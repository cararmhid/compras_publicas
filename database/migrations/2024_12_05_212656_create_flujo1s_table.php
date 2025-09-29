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
        Schema::create('flujo1s', function (Blueprint $table) {
            $table->id();
            $table->string('nro_nec', 255)->nullable();
            $table->string('orden', 255);
            $table->string('dpto', 255);
            $table->string('descripcion', 255);
            $table->integer('id_user');
            $table->integer('tiempo');
            $table->string('formulario', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flujo1s');
    }
};
