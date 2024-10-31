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
        Schema::create('movimiento_cajas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('caja_id')->nullable();
            $table->foreign('caja_id')->references('id')->on('cajas')->cascadeOnUpdate()->restrictOnDelete();
            $table->enum('tipo', ['ingreso', 'egreso']);
            $table->decimal('monto', 18, 2);
            $table->string('descripcion')->nullable();
            $table->unsignedBigInteger('compra_id')->nullable();
            $table->foreign('compra_id')->references('id')->on('compras')->cascadeOnUpdate()->restrictOnDelete();
            $table->unsignedBigInteger('venta_id')->nullable();
            $table->foreign('venta_id')->references('id')->on('ventas')->cascadeOnUpdate()->restrictOnDelete();
            $table->unsignedBigInteger('transaccion_empleado_id')->nullable();
            $table->foreign('transaccion_empleado_id')->references('id')->on('transacciones_empleados')->cascadeOnUpdate()->restrictOnDelete();
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
        Schema::dropIfExists('movimiento_cajas');
    }
};
