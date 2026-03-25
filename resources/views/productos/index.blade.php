@extends('layouts.app')

@section('title', 'Inventario')

@section('content')
<div class="space-y-8">

    {{-- Encabezado --}}
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-[#1e3a8a]">Gestión de Inventario</h1>
            <p class="text-gray-600 mt-1">Administra tus productos y stock</p>
        </div>
        <div class="flex items-center gap-4">
            {{-- Botón BEES Colombia --}}
            <a href="https://www.mybees.com.co/" target="_blank" 
               class="bg-white border-2 border-[#f59e0b] text-[#f59e0b] hover:bg-[#f59e0b] hover:text-white px-4 py-3 rounded-lg font-bold transition-all hover:scale-105 flex items-center gap-2 shadow-sm"
               title="Ir a BEES Colombia">
                <span class="text-xl">🛒</span>
                <span class="hidden md:inline">Surtir en BEES</span>
            </a>

            {{-- Botón Nuevo Producto --}}
            <button onclick="abrirModal()"
                class="bg-[#1e3a8a] hover:bg-[#1e2e6b] text-white px-6 py-3 rounded-lg font-medium transition-all hover:scale-105 flex items-center gap-2 shadow-lg">
                <span class="text-xl">+</span> Nuevo Producto
            </button>
        </div>
    </div>

    {{-- Estadísticas --}}
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-6">
        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-[#1e3a8a] hover:scale-105 transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-gray-500 text-sm font-medium">Total Productos</h3>
                    <p class="text-2xl font-bold text-gray-900 mt-1">{{ $totalProductos }}</p>
                </div>
                <div class="text-3xl">📦</div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-green-500 hover:scale-105 transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-gray-500 text-sm font-medium">Activos</h3>
                    <p class="text-2xl font-bold text-gray-900 mt-1">{{ $totalActivos }}</p>
                </div>
                <div class="text-3xl">✅</div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-red-500 hover:scale-105 transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-gray-500 text-sm font-medium">Inactivos</h3>
                    <p class="text-2xl font-bold text-gray-900 mt-1">{{ $totalInactivos }}</p>
                </div>
                <div class="text-3xl">⛔</div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-[#f59e0b] hover:scale-105 transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-gray-500 text-sm font-medium">Valor Inventario</h3>
                    <p class="text-2xl font-bold text-gray-900 mt-1">${{ number_format($valorInventario, 2) }}</p>
                </div>
                <div class="text-3xl">💰</div>
            </div>
        </div>
                {{-- Tarjeta Stock Bajo --}}
        <div class="relative group bg-white rounded-xl shadow-lg p-6 border-l-4 border-red-500 hover:scale-105 transition-all cursor-help"
            onmouseenter="mostrarDetallesStock()">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-gray-500 text-sm font-medium">Stock Bajo</h3>
                    <p class="text-2xl font-bold text-gray-900 mt-1">{{ $stockBajo }}</p>
                </div>
                <div class="text-3xl">⚠️</div>
            </div>
            
            <div id="modal-hover-stock" class="absolute top-full left-0 mt-2 w-64 bg-white border border-gray-200 shadow-2xl rounded-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all z-[60] p-4">
                <h4 class="text-xs font-bold text-red-600 uppercase mb-2">Productos Críticos</h4>
                <ul id="lista-hover-stock" class="text-sm text-gray-700 max-h-40 overflow-y-auto">
                    <li class="py-1">Cargando...</li>
                </ul>
            </div>
        </div>

        {{-- Tarjeta Categorías --}}
        <div class="relative group bg-white rounded-xl shadow-lg p-6 border-l-4 border-green-500 hover:scale-105 transition-all cursor-help"
            onmouseenter="mostrarDetallesCategorias()">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-gray-500 text-sm font-medium">Categorías</h3>
                    <p class="text-2xl font-bold text-gray-900 mt-1">{{ $totalCategorias }}</p>
                </div>
                <div class="text-3xl">📋</div>
            </div>

            <div id="modal-hover-categorias" class="absolute top-full left-0 mt-2 w-48 bg-white border border-gray-200 shadow-2xl rounded-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all z-[60] p-4">
                <h4 class="text-xs font-bold text-green-600 uppercase mb-2">En Uso</h4>
                <ul id="lista-hover-categorias" class="text-sm text-gray-700">
                    <li class="py-1">Cargando...</li>
                </ul>
            </div>
        </div>
    </div>

    {{-- Filtros --}}
    <div class="bg-white rounded-xl shadow-lg p-6">
        <div class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                <input type="text" id="buscar-producto" placeholder="Buscar por nombre o código..."
                    oninput="filtrarProductos()"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1e3a8a] focus:border-transparent">
            </div>
            <select id="filtro-categoria" onchange="filtrarProductos()"
                class="px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1e3a8a]">
                <option value="">Todas las categorías</option>
                <option value="General">General</option>
                <option value="Bebidas">Bebidas</option>
                <option value="Snacks">Snacks</option>
                <option value="Congelados">Congelados</option>
                <option value="Lácteos">Lácteos</option>
                <option value="Dulces">Dulces</option>
                <option value="Cigarros">Cigarros</option>
            </select>
            <select id="filtro-stock" onchange="filtrarProductos()"
                class="px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1e3a8a]">
                <option value="">Todo el stock</option>
                <option value="bajo">Stock bajo (≤5)</option>
                <option value="disponible">Con stock (>0)</option>
                <option value="agotado">Sin stock (0)</option>
            </select>
            <select id="filtro-estado" onchange="filtrarProductos()"
                class="px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1e3a8a]">
                <option value="activo">Activos</option>
                <option value="inactivo">Inactivos</option>
                <option value="">Todos</option>
            </select>
        </div>
    </div>

    {{-- Tabla --}}
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-[#1e3a8a]">Lista de Productos</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-[#1e3a8a] text-white">
                    <tr>
                        <th class="px-6 py-4 text-left font-medium">Producto</th>
                        <th class="px-6 py-4 text-left font-medium">Categoría</th>
                        <th class="px-6 py-4 text-left font-medium">Precio</th>
                        <th class="px-6 py-4 text-left font-medium">Stock</th>
                        <th class="px-6 py-4 text-left font-medium">Valor Total</th>
                        <th class="px-6 py-4 text-center font-medium">Acciones</th>
                    </tr>
                </thead>
                <tbody id="productos-list">
                    @forelse($productos->where('activo', 1) as $producto)
                    <tr class="border-b border-gray-200 hover:bg-gray-50" id="prod-{{ $producto->id }}">
                        <td class="px-6 py-4">
                            <div class="font-medium text-gray-900">{{ $producto->nombre }}</div>
                            @if($producto->codigo_barras)
                            <div class="text-xs text-gray-500">{{ $producto->codigo_barras }}</div>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <span
                                class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">{{ $producto->categoria }}</span>
                        </td>
                        <td class="px-6 py-4 font-medium">${{ number_format($producto->precio, 2) }}</td>
                        <td class="px-6 py-4">
                            <span class="font-bold {{ $producto->stock <= 5 ? 'text-red-600' : 'text-green-600' }}">
                                {{ $producto->stock }}
                            </span>
                            @if($producto->stock <= 5) <span class="text-xs text-red-500 ml-1">⚠️ Bajo</span>
                                @endif
                        </td>
                        <td class="px-6 py-4 text-gray-600">
                            ${{ number_format($producto->precio * $producto->stock, 2) }}</td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex justify-center gap-2">
                                <button onclick="editarProducto({{ $producto->toJson() }})"
                                    class="bg-[#f59e0b] hover:bg-yellow-500 text-white px-3 py-1 rounded text-sm transition">
                                    Editar
                                </button>
                                <button onclick="desactivarProducto('{{ $producto->id }}')"
                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm transition">
                                    Desactivar
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                            <div class="text-4xl mb-4">📦</div>
                            <p>No hay productos registrados</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Modal --}}
<div id="producto-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50 hidden">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">
        <div class="p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-bold text-[#1e3a8a]" id="modal-titulo">Nuevo Producto</h3>
                <button onclick="cerrarModal()" class="text-gray-400 hover:text-gray-600 text-2xl">×</button>
            </div>
            <div id="form-messages"></div>
            <form id="producto-form" class="space-y-6">
                @csrf
                <input type="hidden" id="producto-id">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nombre *</label>
                        <input type="text" id="f-nombre" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1e3a8a]"
                            placeholder="Ej: Coca Cola 600ml">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Precio *</label>
                        <input type="number" step="0.01" min="0" id="f-precio" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1e3a8a]"
                            placeholder="0.00">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Precio de Compra</label>
                        <input type="number" step="0.01" min="0" id="f-precio-compra"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1e3a8a]"
                            placeholder="0.00">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Stock</label>
                        <input type="number" min="0" id="f-stock"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1e3a8a]"
                            placeholder="0">
                    </div>
                    <div id="suma-stock-container" class="hidden">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Sumar Stock</label>
                        <input type="number" min="0" id="f-suma-stock" value="0"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1e3a8a]"
                            placeholder="Cantidad a sumar">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Categoría</label>
                        <select id="f-categoria"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1e3a8a]">
                            <option value="General">General</option>
                            <option value="Bebidas">Bebidas</option>
                            <option value="Snacks">Snacks</option>
                            <option value="Congelados">Congelados</option>
                            <option value="Lácteos">Lácteos</option>
                            <option value="Dulces">Dulces</option>
                            <option value="Cigarros">Cigarros</option>
                        </select>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Código de Barras</label>
                        <input type="text" id="f-codigo"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1e3a8a]"
                            placeholder="Opcional">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Descripción</label>
                    <textarea id="f-descripcion" rows="3"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1e3a8a]"
                        placeholder="Descripción opcional"></textarea>
                </div>
                <div class="flex gap-4 pt-4">
                    <button type="button" onclick="guardarProducto()"
                        class="flex-1 bg-[#1e3a8a] hover:bg-[#1e2e6b] text-white py-3 px-6 rounded-lg font-medium transition-all">
                        <span id="btn-texto">Crear Producto</span>
                    </button>
                    <button type="button" onclick="cerrarModal()"
                        class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                        Cancelar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
let productoEditandoId = null;

function abrirModal() {
    productoEditandoId = null;
    document.getElementById('modal-titulo').textContent = 'Nuevo Producto';
    document.getElementById('btn-texto').textContent = 'Crear Producto';
    document.getElementById('producto-form').reset();
    document.getElementById('producto-id').value = '';
    document.getElementById('suma-stock-container').classList.add('hidden');
    document.getElementById('f-stock').readOnly = false;
    document.getElementById('producto-modal').classList.remove('hidden');
}

function editarProducto(producto) {
    productoEditandoId = producto.id;
    document.getElementById('modal-titulo').textContent = 'Editar Producto';
    document.getElementById('btn-texto').textContent = 'Actualizar Producto';
    document.getElementById('producto-id').value = producto.id;
    document.getElementById('f-nombre').value = producto.nombre;
    document.getElementById('f-precio').value = producto.precio;
    document.getElementById('f-precio-compra').value = producto.precio_compra ?? '';
    document.getElementById('f-stock').value = producto.stock;
    document.getElementById('f-stock').readOnly = true;
    document.getElementById('f-suma-stock').value = 0;
    document.getElementById('suma-stock-container').classList.remove('hidden');
    document.getElementById('f-categoria').value = producto.categoria;
    document.getElementById('f-codigo').value = producto.codigo_barras ?? '';
    document.getElementById('f-descripcion').value = producto.descripcion ?? '';
    document.getElementById('producto-modal').classList.remove('hidden');
}

function cerrarModal() {
    document.getElementById('producto-modal').classList.add('hidden');
    document.getElementById('form-messages').innerHTML = '';
    productoEditandoId = null;
}

async function guardarProducto() {
    const nombre = document.getElementById('f-nombre').value.trim();
    const precio = parseFloat(document.getElementById('f-precio').value);
    if (!nombre || !precio || precio <= 0) {
        mostrarMsgForm('Nombre y precio son requeridos', 'error');
        return;
    }

    const data = {
        nombre,
        precio,
        precio_compra: parseFloat(document.getElementById('f-precio-compra').value) || 0,
        stock: parseInt(document.getElementById('f-stock').value) || 0,
        suma_stock: parseInt(document.getElementById('f-suma-stock').value) || 0,
        categoria: document.getElementById('f-categoria').value,
        codigo_barras: document.getElementById('f-codigo').value.trim(),
        descripcion: document.getElementById('f-descripcion').value.trim(),
    };

    const url = productoEditandoId ? `/productos/${productoEditandoId}` : '/productos';
    const method = productoEditandoId ? 'PUT' : 'POST';

    try {
        const res = await fetch(url, {
            method,
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify(data)
        });
        const result = await res.json();
        if (result.success) {
            mostrarToast(productoEditandoId ? '✅ Producto actualizado' : '✅ Producto creado', 'exito');
            cerrarModal();
            setTimeout(() => location.reload(), 1000);
        } else {
            mostrarMsgForm(result.message ?? 'Error al guardar', 'error');
        }
    } catch (e) {
        mostrarMsgForm('Error de conexión', 'error');
    }
}

async function desactivarProducto(id) {
    if (!confirm('¿Desactivar este producto?')) return;
    const res = await fetch(`/productos/${id}/desactivar`, {
        method: 'PATCH',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    });
    const data = await res.json();
    if (data.success) {
        document.getElementById(`prod-${id}`)?.remove();
        mostrarToast('Producto desactivado', 'exito');
    }
}

async function filtrarProductos() {
    const params = new URLSearchParams({
        buscar: document.getElementById('buscar-producto').value,
        categoria: document.getElementById('filtro-categoria').value,
        stock: document.getElementById('filtro-stock').value,
        estado: document.getElementById('filtro-estado').value,
    });

    const res = await fetch(`/productos/filtrar?${params}`);
    const productos = await res.json();
    const tbody = document.getElementById('productos-list');

    if (productos.length === 0) {
        tbody.innerHTML =
            `<tr><td colspan="6" class="px-6 py-12 text-center text-gray-500"><div class="text-4xl mb-4">📦</div><p>No hay productos</p></td></tr>`;
        return;
    }

    tbody.innerHTML = productos.map(p => `
                <tr class="border-b border-gray-200 hover:bg-gray-50" id="prod-${p.id}">
                    <td class="px-6 py-4">
                        <div class="font-medium text-gray-900">${p.nombre}</div>
                        ${p.codigo_barras ? `<div class="text-xs text-gray-500">${p.codigo_barras}</div>` : ''}
                    </td>
                    <td class="px-6 py-4"><span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">${p.categoria}</span></td>
                    <td class="px-6 py-4 font-medium">$${parseFloat(p.precio).toFixed(2)}</td>
                    <td class="px-6 py-4">
                        <span class="font-bold ${p.stock <= 5 ? 'text-red-600' : 'text-green-600'}">${p.stock}</span>
                        ${p.stock <= 5 ? '<span class="text-xs text-red-500 ml-1">⚠️ Bajo</span>' : ''}
                    </td>
                    <td class="px-6 py-4 text-gray-600">$${(parseFloat(p.precio) * p.stock).toFixed(2)}</td>
                    <td class="px-6 py-4 text-center">
                        <div class="flex justify-center gap-2">
                            <button onclick='editarProducto(${JSON.stringify(p)})' class="bg-[#f59e0b] hover:bg-yellow-500 text-white px-3 py-1 rounded text-sm">Editar</button>
                            ${p.activo
                    ? `<button onclick="desactivarProducto('${p.id}')" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">Desactivar</button>`
                    : `<button onclick="activarProducto('${p.id}')" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-sm">Activar</button>`
                }
                        </div>
                    </td>
                </tr>
            `).join('');
}

async function activarProducto(id) {
    const res = await fetch(`/productos/${id}/activar`, {
        method: 'PATCH',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    });
    const data = await res.json();
    if (data.success) {
        mostrarToast('Producto activado', 'exito');
        filtrarProductos();
    }
}

function mostrarMsgForm(msg, tipo) {
    document.getElementById('form-messages').innerHTML = `
                <div class="${tipo === 'error' ? 'bg-red-50 border-red-200 text-red-700' : 'bg-green-50 border-green-200 text-green-700'} border px-4 py-3 rounded-lg mb-4">
                    <div class="flex items-center gap-2"><span>${tipo === 'error' ? '⚠️' : '✅'}</span>${msg}</div>
                </div>`;
    setTimeout(() => document.getElementById('form-messages').innerHTML = '', 5000);
}

function mostrarToast(msg, tipo) {
    const div = document.createElement('div');
    div.className =
        `fixed top-4 right-4 ${tipo === 'exito' ? 'bg-green-500' : 'bg-red-500'} text-white px-6 py-4 rounded-lg shadow-lg z-50`;
    div.innerHTML = `<div class="flex items-center gap-2"><span>${tipo === 'exito' ? '✅' : '❌'}</span>${msg}</div>`;
    document.body.appendChild(div);
    setTimeout(() => div.remove(), 4000);
}

let stockCargado = false;
let categoriasCargadas = false;

async function mostrarDetallesStock() {
    if (stockCargado) return;
    const lista = document.getElementById('lista-hover-stock');
    
    try {
        const res = await fetch('/productos/filtrar?stock=bajo');
        const productos = await res.json();
        
        if (productos.length === 0) {
            lista.innerHTML = '<li class="text-gray-400 italic">Todo en orden</li>';
        } else {
            lista.innerHTML = productos.map(p => `
                <li class="flex justify-between border-b border-gray-50 py-1">
                    <span>${p.nombre}</span>
                    <span class="font-bold text-red-600">${p.stock}</span>
                </li>
            `).join('');
        }
        stockCargado = true;
    } catch (e) {
        lista.innerHTML = '<li>Error al cargar</li>';
    }
}

async function mostrarDetallesCategorias() {
    if (categoriasCargadas) return;
    const lista = document.getElementById('lista-hover-categorias');
    
    try {
       
        const res = await fetch('/productos/filtrar?estado=activo');
        const productos = await res.json();
        
        
        const categorias = [...new Set(productos.map(p => p.categoria))];
        
        lista.innerHTML = categorias.map(c => `
            <li class="py-1 flex items-center gap-2">
                <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                ${c}
            </li>
        `).join('');
        categoriasCargadas = true;
    } catch (e) {
        lista.innerHTML = '<li>Error al cargar</li>';
    }
}
</script>
@endpush