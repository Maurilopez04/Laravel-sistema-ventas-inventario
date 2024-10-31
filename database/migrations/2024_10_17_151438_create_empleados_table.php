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
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();
            $table->string('cedula', 20)->unique();
            $table->string('nombre', 100);
            $table->decimal('sueldo', 10, 2);
            $table->string('puesto', 100);
            $table->string('numero', 50)->nullable();
            $table->string('correo', 255)->nullable();
            $table->date('fecha_contratacion');
            $table->boolean('casado')->default(false);
            $table->integer('hijos')->default(0);
            $table->string('ubicacion', 255)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->charset = 'utf8mb4';
    $table->collation = 'utf8mb4_unicode_ci';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};
