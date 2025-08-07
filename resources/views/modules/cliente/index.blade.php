@extends('layouts.app')
@section('content')
    <h1>Clientes</h1><a href="{{ route('cliente.create') }}" class="btn btn-primary">Crear</a>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Cliente</th>
            <th scope="col">Apellido</th>
            <th scope="col">Direccion</th>
            <th scope="col">Nit</th>
            <th scope="col">Estado</th>
            <th scope="col">Iva</th>
        </tr>
        </thead>
        <tbody>
        @foreach($clientes as $cliente)
            <tr>
                <th scope="row">{{ $cliente->id }}</th>
                <td>{{ $cliente->nombre }}</td>
                <td>{{ $cliente->apellido }}</td>
                <td>{{ $cliente->direccion }}</td>
                <td>{{ $cliente->nit }}</td>
                <td>{{ $cliente->activo }}</td>
                <td>{{ $cliente->porcentaje_iva }}</td>
                <td>
                    <a href="{{ route('cliente.edit', $cliente) }}" type="button" class="btn btn-primary">Editar</a>
                    <form action="{{ route('cliente.destroy', $cliente) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de querer eliminar esta cliente?')">Eliminar</button>
                    </form>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
@endsection
