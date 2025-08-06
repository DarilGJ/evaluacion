@extends('layouts.app')
@section('content')
    <h1>Actualizar Factura #{{ $factura->id }}</h1>
    <form action="{{ route('facturar.update', $factura->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="cliente_id" class="form-label">Cliente</label>
            <select name="cliente_id" class="form-select" required>
                @foreach ($clientes as $cliente)
                    <option value="{{ $cliente->id }}" {{ $cliente->id == $factura->cliente_id ? 'selected' : '' }}>
                        {{ $cliente->nombre }} - {{ $cliente->nit }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha</label>
            <input type="date" class="form-control" id="fecha" name="fecha" value="{{ $factura->fecha }}" required>
        </div>
        <div class="mb-3">
            <label for="comentario" class="form-label">Comentario</label>
            <input type="text" class="form-control" id="comentario" name="comentario" value="{{ $factura->comentario }}">
        </div>

        <div id="repeater-container">
            @foreach($factura->detalle as $index => $detalle)
            <div class="card mb-3 repeater-item" data-index="{{ $index }}">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Producto #{{ $index + 1 }}</span>
                    <button type="button" class="btn btn-sm btn-danger remove-item" onclick="removeItem(this)"
                        title="Eliminar producto">
                        &times;
                    </button>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label for="productos[{{ $index }}][producto_id]" class="form-label">Producto:</label>
                            <select name="productos[{{ $index }}][producto_id]" class="form-select" required>
                                <option value="">Seleccionar producto...</option>
                                @foreach ($productos as $producto)
                                    <option value="{{ $producto->id }}" {{ $producto->id == $detalle->producto_id ? 'selected' : '' }}>
                                        {{ $producto->descripcion }} - Q.{{ $producto->costo_unitario }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="productos[{{ $index }}][cantidad]" class="form-label">Cantidad:</label>
                            <input type="number" name="productos[{{ $index }}][cantidad]" class="form-control" min="1" value="{{ $detalle->cantidad }}" required>
                        </div>

                        <div class="col-md-4">
                            <label for="productos[{{ $index }}][descuento]" class="form-label">Descuento (%):</label>
                            <input type="number" name="productos[{{ $index }}][descuento]" class="form-control" min="0" max="100" step="0.01" value="{{ $detalle->descuento }}" required>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <button type="button" id="add-item" class="btn btn-secondary mb-3">+ Agregar Producto</button>

        <div class="d-flex justify-content-end">
            <a href="{{ route('facturar.index') }}" class="btn btn-secondary me-2">Cancelar</a>
            <button type="submit" class="btn btn-primary">Actualizar Factura</button>
        </div>
    </form>

    <script>
        let itemIndex = {{ count($factura->detalle) }};

        document.getElementById('add-item').addEventListener('click', function() {
            const container = document.getElementById('repeater-container');
            const newItem = document.createElement('div');
            newItem.className = 'card mb-3 repeater-item';
            newItem.setAttribute('data-index', itemIndex);
            newItem.innerHTML = `
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Producto #${itemIndex + 1}</span>
                    <button type="button" class="btn btn-sm btn-danger remove-item" onclick="removeItem(this)" title="Eliminar producto">
                        &times;
                    </button>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label for="productos[${itemIndex}][producto_id]" class="form-label">Producto:</label>
                            <select name="productos[${itemIndex}][producto_id]" class="form-select" required>
                                <option value="">Seleccionar producto...</option>
                                @foreach ($productos as $producto)
                                    <option value="{{ $producto->id }}">{{ $producto->descripcion }} - Q.{{ $producto->costo_unitario }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="productos[${itemIndex}][cantidad]" class="form-label">Cantidad:</label>
                            <input type="number" name="productos[${itemIndex}][cantidad]" class="form-control" min="1" value="1" required>
                        </div>
                        <div class="col-md-4">
                            <label for="productos[${itemIndex}][descuento]" class="form-label">Descuento (%):</label>
                            <input type="number" name="productos[${itemIndex}][descuento]" class="form-control" min="0" max="100" step="0.01" value="0" required>
                        </div>
                    </div>
                </div>
            `;
            container.appendChild(newItem);
            itemIndex++;
            updateItemNumbers();
        });

        function removeItem(button) {
            const item = button.closest('.repeater-item');
            const container = document.getElementById('repeater-container');
            
            if (container.children.length > 1) {
                item.remove();
                updateItemNumbers();
            } else {
                alert('Debe haber al menos un producto en la factura.');
            }
        }

        function updateItemNumbers() {
            const items = document.querySelectorAll('.repeater-item');
            items.forEach((item, index) => {
                const title = item.querySelector('.card-header span');
                title.textContent = `Producto #${index + 1}`;
                
                const inputs = item.querySelectorAll('input, select');
                inputs.forEach(input => {
                    const name = input.getAttribute('name');
                    if (name && name.includes('[')) {
                        const newName = name.replace(/\[\d+\]/, `[${index}]`);
                        input.setAttribute('name', newName);
                        
                        if (input.tagName === 'INPUT') {
                            const id = input.getAttribute('id');
                            if (id) {
                                input.setAttribute('id', id.replace(/\[\d+\]/, `[${index}]`));
                            }
                        }
                    }
                });
                
                const labels = item.querySelectorAll('label');
                labels.forEach(label => {
                    const forAttr = label.getAttribute('for');
                    if (forAttr && forAttr.includes('[')) {
                        label.setAttribute('for', forAttr.replace(/\[\d+\]/, `[${index}]`));
                    }
                });
                
                item.setAttribute('data-index', index);
            });
        }
    </script>
@endsection