@extends('layouts.app')

@section('title', 'Ventas')

@section('content')
<div class="space-y-8">

    {{-- Encabezado --}}
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-[#1e3a8a]">Gestión de Ventas</h1>
            <p class="text-gray-600 mt-1">Registra y administra las ventas</p>
        </div>
    </div>

    {{-- Estadísticas --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-[#1e3a8a] transform transition-all duration-200 hover:scale-105">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-gray-500 text-sm font-medium">Ventas Hoy</h3>
                    <p class="text-2xl font-bold text-gray-900 mt-1">${{ number_format($ventasHoy, 2) }}</p>
                </div>
                <div class="text-3xl">💰</div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-green-500 transform transition-all duration-200 hover:scale-105">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-gray-500 text-sm font-medium">Promedio Venta</h3>
                    <p class="text-2xl font-bold text-gray-900 mt-1">${{ number_format($promedioHoy, 2) }}</p>
                </div>
                <div class="text-3xl">📊</div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-purple-500 transform transition-all duration-200 hover:scale-105">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-gray-500 text-sm font-medium">Método Popular</h3>
                    <p class="text-2xl font-bold text-gray-900 mt-1 capitalize">{{ $metodoPopular }}</p>
                </div>
                <div class="text-3xl">💳</div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-indigo-500 transform transition-all duration-200 hover:scale-105">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-gray-500 text-sm font-medium">Ventas del Día</h3>
                    <p class="text-2xl font-bold text-gray-900 mt-1">{{ $cantidadHoy }}</p>
                </div>
                <div class="text-3xl">🍻</div>
            </div>
        </div>
    </div>

    {{-- Nueva Venta --}}
    <div class="bg-white rounded-xl shadow-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-xl font-bold text-[#1e3a8a]">Nueva Venta</h3>
            <button onclick="toggleFormulario()"
                class="bg-[#1e3a8a] hover:bg-[#1e2e6b] text-white px-4 py-2 rounded-lg transition-colors">
                <span id="toggle-text">Mostrar Formulario</span>
            </button>
        </div>

        <div id="venta-form-container" class="hidden">
            <div id="venta-messages"></div>

            {{-- Buscar producto --}}
            <div class="mb-8">
                <h4 class="font-semibold text-gray-800 mb-4">Agregar Producto</h4>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div class="md:col-span-2 relative">
                        <input type="text" id="buscar-producto"
                            placeholder="Buscar producto por nombre..."
                            oninput="filtrarProductos(this.value)"
                            autocomplete="off"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1e3a8a] focus:border-transparent">
                        <div id="productos-sugerencias"
                            class="absolute z-10 w-full bg-white border border-gray-300 rounded-lg mt-1 max-h-60 overflow-y-auto shadow-lg hidden">
                        </div>
                    </div>
                    <div>
                        <input type="number" id="cantidad-producto" min="1" value="1"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1e3a8a] focus:border-transparent"
                            placeholder="Cantidad">
                    </div>
                    <div>
                        <button type="button" onclick="agregarAlCarrito()"
                            class="w-full bg-[#f59e0b] hover:bg-yellow-500 text-white py-3 px-4 rounded-lg font-medium transition-colors">
                            Agregar
                        </button>
                    </div>
                </div>
            </div>

            {{-- Carrito --}}
            <div id="carrito-container" class="mb-8 hidden">
                <h4 class="font-semibold text-gray-800 mb-4">Carrito de Compra</h4>
                <div class="bg-gray-50 rounded-lg overflow-hidden overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-[#1e3a8a] text-white">
                            <tr>
                                <th class="px-4 py-3 text-left">Producto</th>
                                <th class="px-4 py-3 text-left">Precio</th>
                                <th class="px-4 py-3 text-left">Cantidad</th>
                                <th class="px-4 py-3 text-left">Subtotal</th>
                                <th class="px-4 py-3 text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="carrito-items" class="bg-white"></tbody>
                        <tfoot class="bg-[#1e3a8a] text-white">
                            <tr>
                                <td colspan="3" class="px-4 py-4 font-bold text-right text-lg">Total:</td>
                                <td class="px-4 py-4 font-bold text-xl" id="total-carrito">$0.00</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            {{-- Método de pago --}}
            <div class="flex flex-col md:flex-row gap-6 items-end">
                <div class="flex-1">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Método de Pago</label>
                    <select id="metodo-pago"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1e3a8a]">
                        <option value="efectivo">💵 Efectivo</option>
                        <option value="tarjeta">💳 Tarjeta</option>
                        <option value="transferencia">🏦 Transferencia</option>
                    </select>
                </div>
                <button onclick="procesarVenta()"
                    class="bg-[#1e3a8a] hover:bg-[#1e2e6b] text-white px-8 py-3 rounded-lg font-bold text-lg transition-all hover:scale-105">
                    Finalizar Venta
                </button>
            </div>
        </div>
    </div>

    {{-- Historial --}}
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h3 class="text-lg font-semibold text-[#1e3a8a]">Historial de Ventas</h3>
            <div class="flex gap-4">
                <select id="filtro-metodo" onchange="filtrarVentas()"
                    class="px-3 py-2 border border-gray-300 rounded-lg text-sm">
                    <option value="">Todos los métodos</option>
                    <option value="efectivo">Efectivo</option>
                    <option value="tarjeta">Tarjeta</option>
                    <option value="transferencia">Transferencia</option>
                </select>
                <input type="date" id="filtro-fecha" onchange="filtrarVentas()"
                    class="px-3 py-2 border border-gray-300 rounded-lg text-sm">
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-[#1e3a8a] text-white">
                    <tr>
                        <th class="px-6 py-4 text-left font-medium">Fecha</th>
                        <th class="px-6 py-4 text-left font-medium">Total</th>
                        <th class="px-6 py-4 text-left font-medium">Método</th>
                        <th class="px-6 py-4 text-left font-medium">Productos</th>
                        <th class="px-6 py-4 text-center font-medium">Acciones</th>
                    </tr>
                </thead>
                <tbody id="ventas-list">
                    @forelse($ventas as $venta)
                    <tr class="border-b border-gray-200 hover:bg-gray-50" id="venta-{{ $venta->id }}">
                        <td class="px-6 py-4 text-sm">{{ $venta->fecha_venta->format('d/m/Y H:i') }}</td>
                        <td class="px-6 py-4 font-bold text-[#1e3a8a]">${{ number_format($venta->total, 2) }}</td>
                        <td class="px-6 py-4 capitalize">{{ $venta->metodo_pago }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $venta->detalles->count() }} producto(s)</td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex justify-center gap-2">
                                <button onclick="verDetalle('{{ $venta->id }}')"
                                    class="bg-[#1e3a8a] hover:bg-[#1e2e6b] text-white px-3 py-1 rounded text-sm transition">
                                    Ver
                                </button>
                                <button onclick="eliminarVenta('{{ $venta->id }}')"
                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm transition">
                                    Borrar
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                            <div class="text-4xl mb-4">🛒</div>
                            <p>No hay ventas registradas</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

{{-- Modal detalle --}}
<div id="modal-detalle" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50 hidden">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-md max-h-[80vh] overflow-y-auto">
        <div class="p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-[#1e3a8a]">Detalle de Venta</h3>
                <button onclick="cerrarModal()" class="text-gray-400 hover:text-gray-600 text-2xl">×</button>
            </div>
            <div id="modal-contenido"></div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Datos de productos desde Laravel
    const productosDisponibles = @json($productos);
    let carrito = [];
    let productoSeleccionado = null;
    let formVisible = false;

    // Toggle formulario
    function toggleFormulario() {
        formVisible = !formVisible;
        document.getElementById('venta-form-container').classList.toggle('hidden', !formVisible);
        document.getElementById('toggle-text').textContent = formVisible ? 'Ocultar Formulario' : 'Mostrar Formulario';
    }

    // Filtrar productos en búsqueda
    function filtrarProductos(query) {
        const sugerencias = document.getElementById('productos-sugerencias');
        if (!query.trim()) { sugerencias.classList.add('hidden'); return; }

        const filtrados = productosDisponibles
            .filter(p => p.nombre.toLowerCase().includes(query.toLowerCase()) || p.codigo_barras?.includes(query))
            .slice(0, 10);

        if (filtrados.length === 0) { sugerencias.classList.add('hidden'); return; }

        sugerencias.innerHTML = filtrados.map(p => `
            <button type="button" onclick="seleccionarProducto(${JSON.stringify(p).replace(/"/g, '&quot;')})"
                class="w-full px-4 py-3 text-left hover:bg-gray-50 border-b border-gray-100 last:border-b-0">
                <div class="font-medium">${p.nombre}</div>
                <div class="text-sm text-gray-600">$${parseFloat(p.precio).toFixed(2)} - Stock: ${p.stock}</div>
            </button>
        `).join('');
        sugerencias.classList.remove('hidden');
    }

    function seleccionarProducto(producto) {
        productoSeleccionado = producto;
        document.getElementById('buscar-producto').value = producto.nombre;
        document.getElementById('productos-sugerencias').classList.add('hidden');
    }

    // Agregar al carrito
    function agregarAlCarrito() {
        if (!productoSeleccionado) { mostrarMensaje('Selecciona un producto', 'error'); return; }
        const cantidad = parseInt(document.getElementById('cantidad-producto').value);
        if (cantidad <= 0) { mostrarMensaje('Ingresa una cantidad válida', 'error'); return; }
        if (cantidad > productoSeleccionado.stock) {
            mostrarMensaje(`Stock insuficiente. Disponible: ${productoSeleccionado.stock}`, 'error'); return;
        }

        const existente = carrito.find(i => i.producto_id === productoSeleccionado.id);
        if (existente) {
            const nueva = existente.cantidad + cantidad;
            if (nueva > productoSeleccionado.stock) {
                mostrarMensaje(`Stock insuficiente. Disponible: ${productoSeleccionado.stock}`, 'error'); return;
            }
            existente.cantidad = nueva;
            existente.subtotal = nueva * existente.precio_unitario;
        } else {
            carrito.push({
                producto_id: productoSeleccionado.id,
                nombre: productoSeleccionado.nombre,
                precio_unitario: parseFloat(productoSeleccionado.precio),
                cantidad: cantidad,
                subtotal: cantidad * parseFloat(productoSeleccionado.precio)
            });
        }

        productoSeleccionado = null;
        document.getElementById('buscar-producto').value = '';
        document.getElementById('cantidad-producto').value = 1;
        renderizarCarrito();
    }

    function removerItem(index) {
        carrito.splice(index, 1);
        renderizarCarrito();
    }

    function actualizarCantidad(index, valor) {
        const nueva = parseInt(valor);
        if (nueva <= 0) { removerItem(index); return; }
        const producto = productosDisponibles.find(p => p.id === carrito[index].producto_id);
        if (nueva > producto.stock) { mostrarMensaje(`Stock insuficiente. Disponible: ${producto.stock}`, 'error'); return; }
        carrito[index].cantidad = nueva;
        carrito[index].subtotal = nueva * carrito[index].precio_unitario;
        renderizarCarrito();
    }

    function renderizarCarrito() {
        const container = document.getElementById('carrito-container');
        const tbody = document.getElementById('carrito-items');
        const total = carrito.reduce((s, i) => s + i.subtotal, 0);

        if (carrito.length === 0) { container.classList.add('hidden'); return; }
        container.classList.remove('hidden');

        tbody.innerHTML = carrito.map((item, index) => `
            <tr class="border-b border-gray-200">
                <td class="px-4 py-3 font-medium">${item.nombre}</td>
                <td class="px-4 py-3">$${item.precio_unitario.toFixed(2)}</td>
                <td class="px-4 py-3">
                    <input type="number" min="1" value="${item.cantidad}"
                        onchange="actualizarCantidad(${index}, this.value)"
                        class="w-20 px-2 py-1 border border-gray-300 rounded text-center">
                </td>
                <td class="px-4 py-3 font-bold text-[#1e3a8a]">$${item.subtotal.toFixed(2)}</td>
                <td class="px-4 py-3 text-center">
                    <button onclick="removerItem(${index})" class="text-red-500 hover:text-red-700 font-bold text-xl">×</button>
                </td>
            </tr>
        `).join('');

        document.getElementById('total-carrito').textContent = `$${total.toFixed(2)}`;
    }

    // Procesar venta
    async function procesarVenta() {
        if (carrito.length === 0) { mostrarMensaje('Agrega productos al carrito', 'error'); return; }
        const metodo = document.getElementById('metodo-pago').value;

        try {
            const response = await fetch('{{ route("ventas.store") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ metodo_pago: metodo, items: carrito })
            });

            const data = await response.json();
            if (data.success) {
                mostrarMensaje('¡Venta procesada exitosamente!', 'exito');
                carrito = [];
                renderizarCarrito();
                setTimeout(() => location.reload(), 1500);
            } else {
                mostrarMensaje(data.error || 'Error al procesar la venta', 'error');
            }
        } catch (e) {
            mostrarMensaje('Error de conexión', 'error');
        }
    }

    // Filtrar historial
    async function filtrarVentas() {
        const metodo = document.getElementById('filtro-metodo').value;
        const fecha  = document.getElementById('filtro-fecha').value;

        const params = new URLSearchParams();
        if (metodo) params.append('metodo_pago', metodo);
        if (fecha)  params.append('fecha', fecha);

        const response = await fetch(`{{ route("ventas.filtrar") }}?${params}`);
        const ventas = await response.json();

        const tbody = document.getElementById('ventas-list');
        if (ventas.length === 0) {
            tbody.innerHTML = `<tr><td colspan="5" class="px-6 py-12 text-center text-gray-500"><div class="text-4xl mb-4">🛒</div><p>No hay ventas</p></td></tr>`;
            return;
        }

        tbody.innerHTML = ventas.map(v => `
            <tr class="border-b border-gray-200 hover:bg-gray-50" id="venta-${v.id}">
                <td class="px-6 py-4 text-sm">${new Date(v.fecha_venta).toLocaleString('es-CO')}</td>
                <td class="px-6 py-4 font-bold text-[#1e3a8a]">$${parseFloat(v.total).toFixed(2)}</td>
                <td class="px-6 py-4 capitalize">${v.metodo_pago}</td>
                <td class="px-6 py-4 text-sm text-gray-600">${v.detalles_venta?.length ?? 0} producto(s)</td>
                <td class="px-6 py-4 text-center">
                    <div class="flex justify-center gap-2">
                        <button onclick="verDetalle('${v.id}')" class="bg-[#1e3a8a] hover:bg-[#1e2e6b] text-white px-3 py-1 rounded text-sm">Ver</button>
                        <button onclick="eliminarVenta('${v.id}')" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">Borrar</button>
                    </div>
                </td>
            </tr>
        `).join('');
    }

    // Ver detalle
    function verDetalle(id) {
        const response = fetch(`/ventas/${id}/detalle`)
            .then(r => r.json())
            .then(venta => {
                const detalles = venta.detalles?.map(d => `
                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                        <div>
                            <div class="font-medium">${d.producto?.nombre ?? 'Producto'}</div>
                            <div class="text-sm text-gray-600">Cantidad: ${d.cantidad}</div>
                        </div>
                        <div class="text-right">
                            <div class="font-medium">$${parseFloat(d.subtotal).toFixed(2)}</div>
                            <div class="text-sm text-gray-600">$${parseFloat(d.precio_unitario).toFixed(2)} c/u</div>
                        </div>
                    </div>
                `).join('') ?? '<p class="text-gray-500">Sin detalles</p>';

                document.getElementById('modal-contenido').innerHTML = `
                    <div class="mb-4 p-4 bg-gray-50 rounded-lg grid grid-cols-2 gap-4 text-sm">
                        <div><span class="text-gray-600">Fecha:</span><div class="font-medium">${new Date(venta.fecha_venta).toLocaleString('es-CO')}</div></div>
                        <div><span class="text-gray-600">Método:</span><div class="font-medium capitalize">${venta.metodo_pago}</div></div>
                    </div>
                    <h4 class="font-semibold mb-2">Productos:</h4>
                    <div class="space-y-1 mb-4">${detalles}</div>
                    <div class="pt-4 border-t border-gray-200 flex justify-between items-center text-lg font-bold">
                        <span>Total:</span>
                        <span class="text-[#1e3a8a]">$${parseFloat(venta.total).toFixed(2)}</span>
                    </div>
                `;
                document.getElementById('modal-detalle').classList.remove('hidden');
            });
    }

    function cerrarModal() {
        document.getElementById('modal-detalle').classList.add('hidden');
    }

    // Eliminar venta
    async function eliminarVenta(id) {
        if (!confirm('¿Estás seguro de borrar esta venta?')) return;
        const response = await fetch(`/ventas/${id}`, {
            method: 'DELETE',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
        });
        const data = await response.json();
        if (data.success) {
            document.getElementById(`venta-${id}`)?.remove();
            mostrarMensaje('Venta eliminada', 'exito');
        }
    }

    function mostrarMensaje(msg, tipo) {
        const div = document.createElement('div');
        div.className = `fixed top-4 right-4 ${tipo === 'exito' ? 'bg-green-500' : 'bg-red-500'} text-white px-6 py-4 rounded-lg shadow-lg z-50`;
        div.innerHTML = `<div class="flex items-center gap-2"><span>${tipo === 'exito' ? '✅' : '❌'}</span>${msg}</div>`;
        document.body.appendChild(div);
        setTimeout(() => div.remove(), 4000);
    }
</script>
@endpush