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
        // Schema::create('usuario_rol', function (Blueprint $table) {
        //     $table->unsignedBigInteger('rol_id');
        //     $table->foreign('rol_id','fk_usuariorol_rol')->references('id')->on('roles')->onDelete('restrict')->onUpdate('restrict');
        //     $table->unsignedBigInteger('usuario_id');
        //     $table->foreign('usuario_id','fk_usuariorol_usuario')->references('id')->on('usuarios')->onDelete('restrict')->onUpdate('restrict');
        //     $table->charset = 'utf8mb4';
        //     $table->collation = 'utf8mb4_spanish_ci';
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuario_rol');
    }
};
