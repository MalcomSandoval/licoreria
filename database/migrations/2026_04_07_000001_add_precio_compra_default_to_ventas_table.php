<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('ventas', function (Blueprint $table) {
            // Si la columna ya fue creada manualmente, cambiarle el default a 0
            if (Schema::hasColumn('ventas', 'precio_compra')) {
                $table->decimal('precio_compra', 20, 6)->default(0)->nullable()->change();
            } else {
                $table->decimal('precio_compra', 20, 6)->default(0)->after('total');
            }
        });
    }

    public function down(): void
    {
        Schema::table('ventas', function (Blueprint $table) {
            if (Schema::hasColumn('ventas', 'precio_compra')) {
                $table->dropColumn('precio_compra');
            }
        });
    }
};
