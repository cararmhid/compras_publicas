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
        Schema::create('poas', function (Blueprint $table) {
            $table->id();
            $table->string('meta');
            $table->unsignedBigInteger('id_direcc');
            $table->unsignedBigInteger('id_dpto');
            $table->string('fecha_ini');
            $table->string('fecha_fin');
            $table->float('valor');
            $table->foreign('id_direcc')->references('id')->on('direccions')->onDelete('cascade');
            $table->foreign('id_dpto')->references('id')->on('depars')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('poas');
    }
};
