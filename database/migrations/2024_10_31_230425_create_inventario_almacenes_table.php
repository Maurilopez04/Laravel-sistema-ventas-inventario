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
        Schema::create('inventario_almacenes', function (Blueprint $table) {
            $table->unsignedBigInteger('almacen_id');
            $table->unsignedBigInteger('producto_id');
            $table->integer('cantidad')->default(0);
        
            $table->primary(['almacen_id', 'producto_id']);
            
            $table->foreign('almacen_id')->references('id')->on('almacens')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('producto_id')->references('id')->on('productos')->cascadeOnUpdate()->cascadeOnDelete();
            
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventario_almacenes');
    }
};
