<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; 

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id('id_usuario'); 
            $table->string('usuario'); 
            $table->string('nombre'); 
            $table->string('apellido'); 
            $table->string('cedula', 10)->unique();
            $table->string('contraseña'); 
            $table->string('correo')->unique();
            $table->char('estado', 1)->default('A'); 
            $table->ipAddress('ip')->default('127.0.0.1'); 
            $table->dateTime('fecha_creacion')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('fecha_actualizacion')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
