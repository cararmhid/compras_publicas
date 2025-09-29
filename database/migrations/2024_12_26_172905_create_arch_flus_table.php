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
        Schema::create('arch_flus', function (Blueprint $table) {
            $table->id();
            $table->string('nro_nec', 255)->nullable();
            $table->string('nro_nec1', 255)->nullable();
            $table->string('nombre_doc', 255)->nullable();
            $table->string('documento', 255)->nullable();
            $table->string('id_user', 255)->nullable();
            $table->string('estado', 255)->nullable();
            $table->string('id_nec', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arch_flus');
    }
};
