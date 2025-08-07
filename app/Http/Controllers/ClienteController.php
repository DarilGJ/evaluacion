<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = \App\Models\Cliente::query()->get();
        return view('modules.cliente.index', ['clientes' => $clientes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cliente = Cliente::query()->get();
        return view('modules.cliente.create', ['cliente' => $cliente]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'direccion' => 'nullable',
            'nit' => 'nullable',
            'activo' => 'required',
            'porcentaje_iva' => 'nullable',
        ]);

        $cliente = Cliente::create([
            'nombre' => $request->input('nombre'),
            'apellido' => $request->input('apellido'),
            'direccion' => $request->input('direccion'),
            'nit' => $request->input('nit'),
            'activo' => $request->has('activo'),
            'porcentaje_iva' => $request->input('porcentaje_iva'),
        ]);


        return redirect()->route('cliente.index');
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
        $cliente = Cliente::query()->findOrFail($id);
        return view('modules.cliente.update', ['cliente' => $cliente]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $cliente = Cliente::query()->findOrFail($id);
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'direccion' => 'nullable',
            'nit' => 'nullable',
            'activo' => 'required',
            'porcentaje_iva' => 'nullable',
        ]);

        $cliente->update([
            'nombre' => $request->input('nombre'),
            'apellido' => $request->input('apellido'),
            'direccion' => $request->input('direccion'),
            'nit' => $request->input('nit'),
            'activo' => $request->has('activo'),
            'porcentaje_iva' => $request->input('porcentaje_iva'),
        ]);
        return redirect()->route('cliente.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cliente = Cliente::query()->findOrFail($id);
        $cliente->delete();
        return redirect()->route('cliente.index');
    }
}
