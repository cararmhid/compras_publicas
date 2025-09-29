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
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('estado');
            $table->string('id_direcc');
            $table->string('id_dpto');
            $table->string('menu1');
            $table->string('menu2');
            $table->string('menu3');
            $table->string('menu4');
            $table->string('menu5');
            $table->string('menu6');
            $table->string('menu7');
            $table->string('menu8');
            $table->string('menu9');
            $table->string('menu10');
            $table->string('menu11');
            $table->string('menu12');
            $table->string('menu13');
            
            $table->rememberToken();
            $table->timestamps();
          //  $table->foreign('id_direcc')->references('id')->on('depars')
         
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
