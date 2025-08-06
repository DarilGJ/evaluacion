<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    /** @use HasFactory<\Database\Factories\FacturaFactory> */
    use HasFactory;
    protected $table = 'facturas';
    protected $fillable = [
        'cliente_id',
        'fecha',
        'activo',
        'comentarios',
        'total',
        'subtotal',
        'iva',
        'descuento',
        'cantidad_productos',
    ];

    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }
}
