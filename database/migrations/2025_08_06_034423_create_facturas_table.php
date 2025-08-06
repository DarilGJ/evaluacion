<?php

use App\Models\Cliente;
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
        Schema::create('facturas', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Cliente::class)->constrained();
            $table->date('fecha');
            $table->boolean('activo')->default(true);
            $table->string('comentarios')->nullable();
            $table->float('total', 4);
            $table->float('subtotal', 4);
            $table->float('iva', 4);
            $table->float('descuento', 4);
            $table->integer('cantidad_productos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facturas');
    }
};
