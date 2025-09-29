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
        Schema::create('flujos', function (Blueprint $table) {
            $table->id();
            $table->string('nro_nec', 255)->nullable();
            $table->string('nro_nec1', 255)->nullable();
            $table->string('orden', 255)->nullable();
            $table->string('dpto', 255)->nullable();
            $table->string('descripcion', 255)->nullable();
            $table->string('id_user', 255)->nullable();
            $table->integer('tiempo')->nullable();
            $table->string('estado', 255)->nullable();
            $table->string('formulario', 255)->nullable();
            $table->timestamp('fecha_ini',)->nullable();
            $table->timestamp('fecha_fin',)->nullable();
            $table->string('observaciones', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flujos');
    }
};
