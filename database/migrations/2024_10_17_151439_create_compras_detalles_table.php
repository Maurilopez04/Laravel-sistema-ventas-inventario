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
        Schema::create('compras_detalles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('compra_id')->nullable();
            $table->foreign('compra_id')->references('id')->on('compras')->cascadeOnUpdate()->nullOnDelete();
            $table->unsignedBigInteger('producto_id')->nullable();
            $table->foreign('producto_id')->references('id')->on('productos')->cascadeOnUpdate()->nullOnDelete();
            $table->integer('cantidad');
            $table->decimal('precio', 15, 2);
            $table->timestamps();
            $table->charset = 'utf8mb4';
    $table->collation = 'utf8mb4_unicode_ci';
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compras_detalles');
    }
};
