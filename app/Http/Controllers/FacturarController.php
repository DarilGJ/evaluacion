<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Cliente;

class FacturarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $facturas = Factura::query()->get();
        return view('modules.facturar.index', ['facturas' => $facturas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productos = Producto::query()->get();
        $clientes = Cliente::query()->get();
        return view('modules.facturar.create', ['productos' => $productos, 'clientes' => $clientes]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => [
                    'required',
                    'exists:clientes,id',
                ],
            'fecha' => 'required',
            'comentario' => 'sometimes',
            'productos' => 'required|array',
            'productos.*.producto_id' => 'required|exists:productos,id',
            'productos.*.cantidad' => 'required|integer|min:1',
            'productos.*.descuento' => 'required|numeric|min:0|max:100',
        ]);

        $factura = Factura::create([
            'cliente_id' => $request->input('cliente_id'),
            'fecha' => $request->input('fecha'),
            'comentario' => $request->input('comentario'),
            'total' => 0,
            'subtotal' => 0,
            'iva' => 0,
            'descuento' => 0,
            'cantidad_productos' => 0,
        ]);

        foreach ($request->input('productos') as $producto) {

            $prod = Producto::query()->findOrFail($producto['producto_id']);

            $factura->detalle()->create([
                'producto_id' => $prod->id,
                'cantidad' => $producto['cantidad'],
                'descuento' => $producto['descuento'],
                'subtotal' => $subtotal = $producto['cantidad'] * $prod->costo_unitario,
                'iva' => $iva = $subtotal * 0.12,
                'total' => $subtotal + $iva - $subtotal * $producto['descuento'] / 100,
            ]);
        }

        $factura->total = $factura->detalle()->sum('total');
        $factura->subtotal = $factura->detalle()->sum('subtotal');
        $factura->iva = $factura->detalle()->sum('iva');
        $factura->descuento = $factura->detalle()->sum('descuento');
        $factura->cantidad_productos = $factura->detalle()->sum('cantidad');
        $factura->save();


        return redirect()->route('facturar.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $factura = Factura::query()->findOrFail($id);
        return view('modules.facturar.update', ['factura'=>$factura]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $factura = Factura::query()->findOrFail($id);
        $factura->detalle()->delete();
        $factura->delete();
        return redirect()->route('facturar.index');
    }
}
