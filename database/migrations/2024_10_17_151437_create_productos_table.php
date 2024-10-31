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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 255)->unique();
            $table->string('codigo_de_barras', 255)->nullable();
            $table->string('nombre', 255);
            $table->text('descripcion')->nullable();
            $table->string('imagen', 255)->nullable();
            $table->decimal('costo', 15, 2)->default(0);
            $table->decimal('precioMayorista', 15, 2)->default(0);
            $table->decimal('precioMinorista', 15, 2)->default(0);
            $table->decimal('precioConInstalacion', 15, 2)->default(0);
            $table->integer('cantidad')->default(0);
            $table->unsignedBigInteger('categoria_id')->nullable();
            $table->foreign('categoria_id')->references('id')->on('categorias')->cascadeOnUpdate()->nullOnDelete();
            $table->unsignedBigInteger('marca_id')->nullable();
            $table->foreign('marca_id')->references('id')->on('marcas')->cascadeOnUpdate()->nullOnDelete();
            
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
        Schema::dropIfExists('productos');
    }
};
