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
        Schema::create('necesidads', function (Blueprint $table) {
            $table->id();
            $table->string('nro_nec', 255)->nullable();
            $table->string('nro_nec1', 255)->nullable();
            $table->string('inic_direcc', 255)->nullable();
            $table->string('sec_direcc', 255)->nullable();
            $table->string('responsable',255)->nullable();
            $table->string('id_direcc',255)->nullable();
            $table->string('id_dpto', 255)->nullable();
            $table->timestamp('fecha_nec')->nullable();
            $table->string('cargo', 255)->nullable();
            $table->string('cuatrimestre', 255)->nullable();
            $table->string('normalizado', 255)->nullable();
            $table->string('id_user', 255)->nullable();
            $table->string('precio_pac', 255)->nullable();
            $table->string('tip_proc', 255) ->nullable();
            $table->string('justific', 255)->nullable();
            $table->string('tip_comp', 255)->nullable();
            $table->string('cpc', 255)->nullable();
            $table->string('descripcion', 255)->nullable();
            $table->string('unidad', 255)->nullable();
            $table->string('cantidad',255)->nullable();
            $table->string('dir_area', 255)->nullable();
            $table->string('dir_adm', 255)->nullable();
            $table->string('Gerente', 255)->nullable();
            $table->string('tipo_flujo', 255)->nullable();
            $table->string('status',255)->nullable();
            $table->string('cod_user',255)->nullable();
            $table->string('precio_eje',255)->nullable();
            $table->integer('nro_cert_poa',255)->nullable();
            $table->string('forma_pago',255)->nullable();
            $table->string('ruc',255)->nullable();
            $table->string('proveedor',255)->nullable();
            $table->integer('id_pac',255)->nullable();
            $table->string('reforma',255)->nullable();            
            $table->unsignedBigInteger('id_poa')->nullable();
            $table->foreign('id_poa')->references('id')->on('poas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('necesidads');
    }
};
