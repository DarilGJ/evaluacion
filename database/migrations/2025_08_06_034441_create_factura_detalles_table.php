<?php

use App\Models\Factura;
use App\Models\Producto;
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
        Schema::create('factura_detalles', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Factura::class)->constrained();
            $table->foreignIdFor(Producto::class)->constrained();
            $table->integer('cantidad');
            $table->float('total', 4);
            $table->float('subtotal', 4);
            $table->float('iva', 4);
            $table->float('descuento', 4);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factura_detalles');
    }
};
