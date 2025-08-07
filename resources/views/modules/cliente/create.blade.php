@extends('layouts.app')
@section('content')
    <h1>Crear Cliente</h1>
    <form class="row g-3" action="{{ route('cliente.store') }}" method="post">
        @csrf
        <div class="mb-3 col-6">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre">
        </div>
        <div class="mb-3 col-6">
            <label for="apellido" class="form-label">Apellidos</label>
            <input type="text" class="form-control" id="apellido" name="apellido">
        </div>
        <div class="mb-3">
            <label for="direccion" class="form-label">Direccion</label>
            <input type="text" class="form-control" id="direccion" name="direccion">
        </div>
        <div class="mb-3 col-4">
            <label for="nit" class="form-label">Nit</label>
            <input type="number" class="form-control" id="nit" name="nit">
        </div>
        <div class="mb-3 col-4">
            <label for="activo" class="form-label">Estado</label>
            <input type="text" class="form-control" id="activo" name="activo">
        </div>
        <div class="mb-3 col-4">
            <label for="porcentaje_iva" class="form-label">% IVA</label>
            <input type="number" class="form-control" id="porcentaje_iva" name="porcentaje_iva">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
