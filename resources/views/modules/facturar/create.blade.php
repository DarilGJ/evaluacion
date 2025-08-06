@extends('layouts.app')
@section('content')
    <h1>Create </h1>
    <form action="{{ route('facturar.store') }} " method="post">
        @csrf
        <div class="mb-3">
            <label for="cliente_id" class="form-label">Cliente</label>
            <input type="number" class="form-control" id="cliente_id" name="cliente_id" required>
        </div>
        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha</label>
            <input type="date" class="form-control" id="fecha" name="fecha" required>
        </div>
        <div class="mb-3">
            <label for="comentario" class="form-label">Comentario</label>
            <input type="text" class="form-control" id="comentario" name="comentario">

        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
