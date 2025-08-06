@extends('layouts.app')
@section('content')
    <h1>Listar Facturas </h1><a href="{{ route('facturar.create') }}" class="btn btn-primary">Crear Factura</a>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Cantidad de Productos</th>
            <th>Iva</th>
            <th>SubTotal</th>
            <th>Descuento</th>
            <th>Total</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($facturas as $factura)
            <tr>
                <td scope="row">{{ $factura->id }}</td>
                <td>{{ $factura->cliente->nombre }}</td>
                <td>{{ $factura->cliente->apellido }}</td>
                <td>{{ $factura->cantidad_productos }}</td>
                <td>{{ $factura->iva }}</td>
                <td>{{ $factura->subtotal }}</td>
                <td>{{ $factura->descuento }}</td>
                <td>{{ $factura->total }}</td>
                <td>
                    <a href="{{ route('facturar.edit', $factura) }}" type="button" class="btn btn-sm btn-primary">Editar</a>
                    <button type="button" class="btn btn-sm btn-danger">Eliminar</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
