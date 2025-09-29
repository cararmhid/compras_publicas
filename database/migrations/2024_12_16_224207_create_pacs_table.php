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
        Schema::create('pacs', function (Blueprint $table) {
            $table->id();
            $table->string('año');
            $table->string('partida');
            $table->string('cpc');
            $table->string('tip_comp');
            $table->string('descripcion');
            $table->string('cantidad');
            $table->string('unidad');
            $table->string('precio');
            $table->string('pc');
            $table->string('sc');
            $table->string('tc');
            $table->string('normalizado');
            $table->string('catalogo');
            $table->unsignedBigInteger('id_proceso');
            $table->string('fondo');
            $table->string('regimen');
            $table->string('reforma');
            $table->string('tipo_presupuesto');
            $table->unsignedBigInteger('id_dpto');
            $table->string('nro_reforma');
            $table->foreign('id_proceso')->references('id')->on('procesos')->onDelete('cascade');
            $table->foreign('id_dpto')->references('id')->on('depars')->onDelete('cascade');
            $table->string('nro_nec', 255)->nullable();
            $table->integer('borrado')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pacs');
    }
};
