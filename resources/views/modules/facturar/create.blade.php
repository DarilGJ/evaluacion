@extends('layouts.app')
@section('content')
    <h1>Create </h1>
    <form action="{{ route('facturar.store') }} " method="post">
        @csrf
        <div class="mb-3">
            <label for="cliente_id" class="form-label">Cliente</label>
            <select name="cliente_id" class="form-select" required>
                @foreach ($clientes as $cliente)
                    <option value="{{ $cliente->id }}">{{ $cliente->nombre }} - {{ $cliente->nit }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha</label>
            <input type="date" class="form-control" id="fecha" name="fecha" required>
        </div>
        <div class="mb-3">
            <label for="comentario" class="form-label">Comentario</label>
            <input type="text" class="form-control" id="comentario" name="comentario">
        </div>

        <div id="repeater-container">
            <div class="card mb-3 repeater-item" data-index="0">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Producto #1</span>
                    <button type="button" class="btn btn-sm btn-danger remove-item" onclick="removeItem(this)"
                        title="Eliminar producto">
                        &times;
                    </button>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label for="productos[0][producto_id]" class="form-label">Producto:</label>
                            <select name="productos[0][producto_id]" class="form-select" required>
                                <option value="">Seleccionar producto...</option>
                                @foreach ($productos as $producto)
                                    <option value="{{ $producto->id }}">{{ $producto->descripcion }} - Q.{{ $producto->costo_unitario }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="productos[0][cantidad]" class="form-label">Cantidad:</label>
                            <input type="number" name="productos[0][cantidad]" class="form-control" min="1" value="1"
                                required>
                        </div>

                        <div class="col-md-4">
                            <label for="productos[0][descuento]" class="form-label">Descuento (%):</label>
                            <input type="number" name="productos[0][descuento]" class="form-control" min="0" max="100"
                                step="0.01" value="0" placeholder="0.00">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-success" onclick="addItem()">+ Agregar Producto</button>
        <div class="d-flex justify-content-end">
            <a href="{{ route('facturar.index') }}" class="btn btn-danger mx-2">Cancelar</a>
            <button type="submit" class="btn btn-primary">Crear Factura</button>
        </div>
    </form>
    <script>
        let itemIndex = 1; // Empezamos en 1 porque ya tenemos el item 0

        function addItem() {
            const container = document.getElementById('repeater-container');
            const newItem = document.createElement('div');
            newItem.className = 'repeater-item';
            newItem.setAttribute('data-index', itemIndex);

            newItem.innerHTML = `
                        <div class="card mb-3 repeater-item" data-index="${itemIndex}">
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
                                    <input type="number" name="productos[${itemIndex}][descuento]" class="form-control" min="0" max="100" step="0.01" value="0" placeholder="0.00">
                                </div>
                            </div>
                        </div>
                    </div> `;

            container.appendChild(newItem);
            itemIndex++;
            updateItemNumbers();
        }

        function removeItem(button) {
            const items = document.querySelectorAll('.repeater-item');
            if (items.length > 1) {
                button.closest('.repeater-item').remove();
                updateItemNumbers();
            } else {
                alert('Debe mantener al menos un producto');
            }
        }

        function updateItemNumbers() {
            const items = document.querySelectorAll('.repeater-item');
            items.forEach((item, index) => {
                const header = item.querySelector('.item-header');
                header.textContent = `Producto #${index + 1}`;
            });
        }

        // Simular envío del formulario para mostrar los datos
        document.getElementById('productsForm').addEventListener('submit', function (e) {
            e.preventDefault();

            const formData = new FormData(this);
            const productos = [];

            // Obtener todos los productos
            const items = document.querySelectorAll('.repeater-item');
            items.forEach((item, index) => {
                const select = item.querySelector(`select[name*="producto_id"]`);
                const cantidad = item.querySelector(`input[name*="cantidad"]`);
                const descuento = item.querySelector(`input[name*="descuento"]`);

                if (select.value) {
                    productos.push({
                        producto_id: select.value,
                        cantidad: cantidad.value,
                        descuento: descuento.value
                    });
                }
            });

            // Mostrar el resultado
            const resultado = document.getElementById('resultado');
            const contenido = document.getElementById('resultado-contenido');
            contenido.textContent = JSON.stringify({ productos: productos }, null, 2);
            resultado.style.display = 'block';

            // Scroll hacia el resultado
            resultado.scrollIntoView({ behavior: 'smooth' });
        });
    </script>
@endsection