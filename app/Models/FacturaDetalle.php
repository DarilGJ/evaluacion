<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacturaDetalle extends Model
{
    /** @use HasFactory<\Database\Factories\FacturaDetalleFactory> */
    use HasFactory;
    protected $table = 'factura_detalles';
    protected $fillable = [
        'factura_id',
        'producto_id',
        'cantidad',
        'total',
        'subtotal',
        'iva',
        'descuento',
    ];

    public function producto(){
        return $this->belongsTo(Producto::class);
    }
}
