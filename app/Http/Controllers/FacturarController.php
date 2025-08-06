<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use Illuminate\Http\Request;

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
        return view('modules.facturar.create');
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
        ]);
        Factura::create([
            'cliente_id' => $request->input('cliente_id'),
            'fecha' => $request->input('fecha'),
            'comentario' => $request->input('comentario'),
            'total' => 0,
            'subtotal' => 0,
            'iva' => 0,
            'descuento' => 0,
            'cantidad_productos' => 0,
        ]);
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
        //
    }
}
