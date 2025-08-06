@extends('layouts.app')
@section('content')
    <h1>Actualizar Factura </h1>

    <form>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Numero de Factura</label>
            <input type="email" class="form-control" id="exampleInputEmail1" value="{{ $factura->id }} " disabled>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

@endsection
