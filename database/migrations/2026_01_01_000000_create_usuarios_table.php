<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->char('id', 36)->primary();
            $table->string('nombre', 100);
            $table->string('correo', 150)->unique();
            $table->string('contrasena');
            $table->string('rol', 50)->default('usuario');
            $table->tinyInteger('activo')->default(0);
            $table->timestamp('created_at')->useCurrent();
        });
    }
    public function down(): void {
        Schema::dropIfExists('usuarios');
    }
};