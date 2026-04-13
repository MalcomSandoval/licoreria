@extends('layouts.app')

@section('title', 'Inventario')

@section('content')
    <div class="space-y-8 animate-fade-in relative">

        {{-- Encabezado --}}
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h1 class="text-3xl font-bold text-white flex items-center gap-3">
                    <span class="p-2 bg-app-primary/20 rounded-xl text-app-primary">📦</span>
                    Gestión de Inventario
                </h1>
                <p class="text-app-textMuted mt-1 ml-14">Administra tus productos y controla el stock</p>
            </div>
            <div class="flex flex-wrap items-center gap-4 w-full md:w-auto mt-4 md:mt-0 ml-14 md:ml-0">
                {{-- Botón BEES Colombia --}}
                <a href="https://www.mybees.com.co/" target="_blank"
                    class="bg-transparent border border-amber-500/50 text-amber-500 hover:bg-amber-500 hover:text-white px-4 py-2.5 rounded-xl font-semibold transition-all hover:scale-105 flex items-center justify-center gap-2 shadow-sm focus:ring-2 focus:ring-amber-500 focus:outline-none"
                    title="Ir a BEES Colombia">
                    <span class="text-lg leading-none">🛒</span>
                    <span class="hidden sm:inline">Surtir en BEES</span>
                </a>

                {{-- Botón Nuevo Producto --}}
                <button onclick="abrirModal()"
                    class="flex-1 md:flex-none bg-app-primary hover:bg-app-primaryHover text-slate-900 px-6 py-2.5 rounded-xl font-bold transition-all hover:scale-105 hover:shadow-[0_0_20px_rgba(245,158,11,0.4)] flex items-center justify-center gap-2 shadow-lg focus:ring-2 focus:ring-app-primary focus:outline-none">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Nuevo Producto
                </button>
            </div>
        </div>

        {{-- Estadísticas --}}
        <div class="grid grid-cols-2 lg:grid-cols-6 gap-4 sm:gap-6">
            <div
                class="bg-app-card rounded-2xl shadow-lg border border-app-accent/50 p-5 hover:border-blue-500/50 transition-colors group">
                <h3 class="text-app-textMuted text-xs font-semibold uppercase tracking-wider mb-2">Total</h3>
                <div class="flex items-end justify-between">
                    <p class="text-2xl sm:text-3xl font-bold text-white group-hover:text-blue-400 transition-colors">
                        {{ $totalProductos }}
                    </p>
                    <div class="text-blue-400/50 group-hover:text-blue-400 transition-colors">
                        <svg class="w-6 h-6 sm:w-8 sm:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div
                class="bg-app-card rounded-2xl shadow-lg border border-app-accent/50 p-5 hover:border-emerald-500/50 transition-colors group">
                <h3 class="text-app-textMuted text-xs font-semibold uppercase tracking-wider mb-2">Activos</h3>
                <div class="flex items-end justify-between">
                    <p class="text-2xl sm:text-3xl font-bold text-white group-hover:text-emerald-400 transition-colors">
                        {{ $totalActivos }}
                    </p>
                    <div class="text-emerald-400/50 group-hover:text-emerald-400 transition-colors">
                        <svg class="w-6 h-6 sm:w-8 sm:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div
                class="bg-app-card rounded-2xl shadow-lg border border-app-accent/50 p-5 hover:border-slate-500/50 transition-colors group">
                <h3 class="text-app-textMuted text-xs font-semibold uppercase tracking-wider mb-2">Inactivos</h3>
                <div class="flex items-end justify-between">
                    <p class="text-2xl sm:text-3xl font-bold text-white group-hover:text-slate-400 transition-colors">
                        {{ $totalInactivos }}
                    </p>
                    <div class="text-slate-400/50 group-hover:text-slate-400 transition-colors">
                        <svg class="w-6 h-6 sm:w-8 sm:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-app-card rounded-2xl shadow-lg border border-app-accent/50 p-5 hover:border-amber-500/50 transition-colors group col-span-2 lg:col-span-1 overflow-hidden flex flex-col justify-between">
                <h3 class="text-app-textMuted text-[10px] uppercase font-semibold tracking-wider mb-1 truncate">
                    Valor Inventario
                </h3>
                
                <div class="flex items-center justify-between gap-2">
                    <div class="flex-1 min-w-0">
                        <p class="text-xl sm:text-2xl font-bold text-white group-hover:text-amber-400 transition-colors leading-none">
                            ${{ $valorInventario >= 1000000 
                                ? number_format($valorInventario/1000000, 2).'M' 
                                : ($valorInventario >= 1000 ? number_format($valorInventario/1000, 1).'K' : number_format($valorInventario, 2)) 
                            }}
                        </p>
                        
                        <p class="text-[10px] text-app-textMuted font-mono mt-1 opacity-80 group-hover:opacity-100 transition-opacity">
                            ${{ number_format($valorInventario, 2) }}
                        </p>
                    </div>

                    <div class="text-amber-400/50 group-hover:text-amber-400 transition-colors shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Tarjeta Stock Bajo --}}
            <div class="relative group bg-app-card rounded-2xl shadow-lg border border-app-accent/50 hover:border-red-500/50 p-5 transition-colors cursor-help col-span-1 lg:col-span-1"
                onmouseenter="mostrarDetallesStock()">
                <h3 class="text-app-textMuted text-xs font-semibold uppercase tracking-wider mb-2">Stock Crítico</h3>
                <div class="flex items-end justify-between">
                    <p class="text-2xl sm:text-3xl font-bold text-red-500">{{ $stockBajo }}</p>
                    <div class="text-red-500/50 group-hover:text-red-500 transition-colors animate-pulse">
                        <svg class="w-6 h-6 sm:w-8 sm:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                            </path>
                        </svg>
                    </div>
                </div>

                <div id="modal-hover-stock"
                    class="absolute top-full right-0 mt-3 w-64 bg-app-card border border-app-accent shadow-2xl rounded-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all z-50 p-4">
                    <h4 class="text-xs font-bold text-red-400 uppercase mb-3 flex items-center gap-2"><span
                            class="w-2 h-2 rounded-full bg-red-500 animate-pulse"></span> Productos Críticos</h4>
                    <ul id="lista-hover-stock" class="text-sm text-app-textMain max-h-48 overflow-y-auto pr-2 space-y-2">
                        <li class="py-1 text-app-textMuted">Cargando...</li>
                    </ul>
                </div>
            </div>

            {{-- Tarjeta Categorías --}}
            <div class="relative group bg-app-card rounded-2xl shadow-lg border border-app-accent/50 hover:border-indigo-500/50 p-5 transition-colors cursor-help col-span-1 lg:col-span-1"
                onmouseenter="mostrarDetallesCategorias()">
                <h3 class="text-app-textMuted text-xs font-semibold uppercase tracking-wider mb-2">Categorías</h3>
                <div class="flex items-end justify-between">
                    <p class="text-2xl sm:text-3xl font-bold text-white group-hover:text-indigo-400 transition-colors">
                        {{ $totalCategorias }}
                    </p>
                    <div class="text-indigo-400/50 group-hover:text-indigo-400 transition-colors">
                        <svg class="w-6 h-6 sm:w-8 sm:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                            </path>
                        </svg>
                    </div>
                </div>

                <div id="modal-hover-categorias"
                    class="absolute top-full right-0 mt-3 w-56 bg-app-card border border-app-accent shadow-2xl rounded-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all z-50 p-4">
                    <h4 class="text-xs font-bold text-indigo-400 uppercase mb-3 border-b border-app-accent/50 pb-2">En Uso
                    </h4>
                    <ul id="lista-hover-categorias" class="text-sm text-app-textMain space-y-2">
                        <li class="py-1 text-app-textMuted">Cargando...</li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- Filtros --}}
        <div class="bg-app-card rounded-2xl shadow-lg border border-app-accent/50 p-6">
            <div class="flex flex-col md:flex-row gap-4">
                <div class="flex-1 relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-app-textMuted">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input type="text" id="buscar-producto" placeholder="Buscar por nombre o código..."
                        oninput="filtrarProductos()"
                        class="w-full pl-11 pr-4 py-3 bg-app-bg/50 border border-app-accent rounded-xl text-white placeholder-app-textMuted/50 focus:outline-none focus:border-app-primary focus:ring-1 focus:ring-app-primary transition duration-200">
                </div>

                <div class="grid grid-cols-2 md:grid-cols-3 gap-4 md:w-auto w-full">
                    <select id="filtro-categoria" onchange="filtrarProductos()"
                        class="px-4 py-3 bg-app-bg/50 border border-app-accent rounded-xl text-white focus:outline-none focus:border-app-primary focus:ring-1 focus:ring-app-primary transition outline-none appearance-none">
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
                        class="px-4 py-3 bg-app-bg/50 border border-app-accent rounded-xl text-white focus:outline-none focus:border-app-primary focus:ring-1 focus:ring-app-primary transition outline-none appearance-none">
                        <option value="">Todo el stock</option>
                        <option value="bajo">Stock bajo (≤5)</option>
                        <option value="disponible">Con stock (>0)</option>
                        <option value="agotado">Sin stock (0)</option>
                    </select>
                    <select id="filtro-estado" onchange="filtrarProductos()"
                        class="col-span-2 md:col-span-1 px-4 py-3 bg-app-bg/50 border border-app-accent rounded-xl text-white focus:outline-none focus:border-app-primary focus:ring-1 focus:ring-app-primary transition outline-none appearance-none">
                        <option value="activo">Activos</option>
                        <option value="inactivo">Inactivos</option>
                        <option value="">Todos</option>
                    </select>
                </div>
            </div>
        </div>

        {{-- Tabla --}}
        <div class="bg-app-card rounded-2xl shadow-lg border border-app-accent/50 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr
                            class="bg-app-bg/80 border-b border-app-accent/50 text-app-textMuted tracking-wider uppercase text-[10px] sm:text-xs">
                            <th class="px-6 py-4 font-semibold">Producto</th>
                            <th class="px-6 py-4 font-semibold">Categoría</th>
                            <th class="px-6 py-4 font-semibold">Precio</th>
                            <th class="px-6 py-4 font-semibold">Stock</th>
                            <th class="px-6 py-4 font-semibold hidden md:table-cell">Valor Total</th>
                            <th class="px-6 py-4 font-semibold text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="productos-list" class="divide-y divide-app-accent/30 text-sm">
                        @forelse($productos->where('activo', 1) as $producto)
                            <tr class="hover:bg-app-bg/50 transition-colors group" id="prod-{{ $producto->id }}">
                                <td class="px-6 py-4">
                                    <div class="font-semibold text-white group-hover:text-app-primary transition-colors">
                                        {{ $producto->nombre }}
                                    </div>
                                    @if($producto->codigo_barras)
                                        <div
                                            class="text-xs text-app-textMuted/70 mt-1 font-mono bg-app-bg inline-block px-2 py-0.5 rounded">
                                            {{ $producto->codigo_barras }}
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="bg-indigo-500/10 text-indigo-400 border border-indigo-500/20 text-xs px-2.5 py-1 rounded-lg">{{ $producto->categoria }}</span>
                                </td>
                                <td class="px-6 py-4 font-medium text-white">${{ number_format($producto->precio, 2) }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <span
                                            class="font-bold {{ $producto->stock <= 5 ? 'text-red-400 bg-red-400/10 px-2 py-0.5 rounded' : 'text-emerald-400' }}">
                                            {{ $producto->stock }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-app-textMuted hidden md:table-cell">
                                    ${{ number_format($producto->precio * $producto->stock, 2) }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <button onclick="editarProducto({{ $producto->toJson() }})"
                                            class="bg-amber-500/10 hover:bg-amber-500 hover:text-white text-amber-500 border border-amber-500/20 px-3 py-1.5 rounded-lg text-xs font-semibold transition-all">
                                            Editar
                                        </button>
                                        <button onclick="desactivarProducto('{{ $producto->id }}')"
                                            class="bg-red-500/10 hover:bg-red-500 hover:text-white text-red-500 border border-red-500/20 px-3 py-1.5 rounded-lg text-xs font-semibold transition-all">
                                            Desactivar
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-16 text-center text-app-textMuted bg-app-bg/20">
                                    <div class="text-5xl mb-4 opacity-50">📦</div>
                                    <p class="text-lg">No hay productos registrados en el inventario</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Modal --}}
    <div id="producto-modal"
        class="fixed inset-0 bg-app-bg/80 backdrop-blur-sm flex items-center justify-center p-4 z-50 hidden opacity-0 transition-opacity duration-300">
        <div class="bg-app-card rounded-2xl shadow-[0_0_40px_rgba(0,0,0,0.5)] border border-app-accent w-full max-w-2xl max-h-[90vh] flex flex-col transform scale-95 transition-transform duration-300"
            id="modal-content">

            <div
                class="p-6 border-b border-app-accent/50 flex justify-between items-center bg-app-card rounded-t-2xl z-10 sticky top-0">
                <h3 class="text-xl font-bold text-white flex items-center gap-2" id="modal-titulo">
                    <span class="text-app-primary">✨</span> Nuevo Producto
                </h3>
                <button onclick="cerrarModal()"
                    class="text-app-textMuted hover:text-white transition-colors p-1 bg-app-bg rounded-lg border border-app-accent hover:bg-red-500/20 hover:border-red-500/50">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>

            <div class="p-6 overflow-y-auto custom-scrollbar">
                <div id="form-messages" class="mb-4"></div>
                <form id="producto-form" class="space-y-6">
                    @csrf
                    <input type="hidden" id="producto-id">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label
                                class="block text-xs font-semibold text-app-textMuted uppercase tracking-wider mb-2">Nombre
                                *</label>
                            <input type="text" id="f-nombre" required
                                class="w-full px-4 py-3 bg-app-bg border border-app-accent rounded-xl text-white focus:outline-none focus:border-app-primary focus:ring-1 focus:ring-app-primary transition"
                                placeholder="Ej: Cerveza Aguila 330ml">
                        </div>

                         <div>
                            <label
                                class="block text-xs font-semibold text-app-textMuted uppercase tracking-wider mb-2">Categoría</label>
                            <select id="f-categoria"
                                class="w-full px-4 py-3 bg-app-bg border border-app-accent rounded-xl text-white focus:outline-none focus:border-app-primary focus:ring-1 focus:ring-app-primary transition outline-none appearance-none">
                                <option value="General">General</option>
                                <option value="Bebidas">Bebidas</option>
                                <option value="Snacks">Snacks</option>
                                <option value="Congelados">Congelados</option>
                                <option value="Lácteos">Lácteos</option>
                                <option value="Dulces">Dulces</option>
                                <option value="Cigarros">Cigarros</option>
                            </select>
                        </div>

                        <div>
                            <label
                                class="block text-xs font-semibold text-app-textMuted uppercase tracking-wider mb-2">Precio
                                Venta *</label>
                            <div class="relative">
                                <span class="absolute left-4 top-3.5 text-app-textMuted">$</span>
                                <input type="number" step="0.01" min="0" id="f-precio" required
                                    class="w-full pl-8 pr-4 py-3 bg-app-bg border border-app-accent rounded-xl text-white focus:outline-none focus:border-app-primary focus:ring-1 focus:ring-app-primary transition"
                                    placeholder="0.00">
                            </div>
                        </div>

                        <div>
                            <label
                                class="block text-xs font-semibold text-app-textMuted uppercase tracking-wider mb-2">Precio
                                de Compra</label>
                            <div class="relative">
                                <span class="absolute left-4 top-3.5 text-app-textMuted">$</span>
                                <input type="number" step="0.01" min="0" id="f-precio-compra"
                                    class="w-full pl-8 pr-4 py-3 bg-app-bg border border-app-accent rounded-xl text-white focus:outline-none focus:border-app-primary focus:ring-1 focus:ring-app-primary transition"
                                    placeholder="0.00">
                            </div>
                        </div>

                        {{-- Precio de Venta de la Caja --}}
                        <div>
                            <label class="block text-xs font-semibold text-app-textMuted uppercase tracking-wider mb-2">
                                Precio Venta (Caja)
                            </label>
                            <div class="relative">
                                <span class="absolute left-4 top-3.5 text-app-textMuted">$</span>
                                <input type="number" step="0.01" min="0" id="f-precio-venta-caja"
                                    class="w-full pl-8 pr-4 py-3 bg-app-bg border border-app-accent rounded-xl text-white focus:outline-none focus:border-app-primary focus:ring-1 focus:ring-app-primary transition"
                                    placeholder="Ej: 52000">
                            </div>
                        </div>

                        {{-- Precio de Compra de la Caja --}}
                        <div>
                            <label class="block text-xs font-semibold text-app-textMuted uppercase tracking-wider mb-2">
                                Precio Compra (Caja)
                            </label>
                            <div class="relative">
                                <span class="absolute left-4 top-3.5 text-app-textMuted">$</span>
                                <input type="number" step="0.01" min="0" id="f-precio-caja" 
                                    class="w-full pl-8 pr-4 py-3 bg-app-bg border border-app-accent rounded-xl text-white focus:outline-none focus:border-app-primary focus:ring-1 focus:ring-app-primary transition"
                                    placeholder="Ej: 45000">
                            </div>
                        </div>

                        <div>
                            <label
                                class="block text-xs font-semibold text-app-textMuted uppercase tracking-wider mb-2">Stock
                                Actual</label>
                            <input type="number" min="0" id="f-stock"
                                class="w-full px-4 py-3 bg-app-bg border border-app-accent rounded-xl text-white focus:outline-none focus:border-app-primary focus:ring-1 focus:ring-app-primary transition"
                                placeholder="0">
                        </div>

                        <div id="suma-stock-container"
                            class="hidden relative p-4 bg-emerald-500/5 border border-emerald-500/20 rounded-xl">
                            <label class="block text-xs font-semibold text-emerald-500 uppercase tracking-wider mb-2">Sumar
                                Stock (+)</label>
                            <input type="number" min="0" id="f-suma-stock" value="0"
                                class="w-full px-4 py-3 bg-app-bg border border-emerald-500/30 rounded-lg text-white focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition"
                                placeholder="Cantidad a sumar">
                        </div>

                        {{-- Cantidad por Caja --}}
                        <div>
                            <label class="block text-xs font-semibold text-app-textMuted uppercase tracking-wider mb-2">
                                Cantidad por Caja
                            </label>
                            <div class="relative">
                                <input type="number" min="1" id="f-cantidad-caja"
                                    class="w-full pl-10 pr-4 py-3 bg-app-bg border border-app-accent rounded-xl text-white focus:outline-none focus:border-app-primary focus:ring-1 focus:ring-app-primary transition"
                                    placeholder="24">
                            </div>
                            <p class="text-[10px] text-app-textMuted/50 mt-1 ml-1">Unidades que trae cada caja/paca</p>
                        </div>

                        <div class="md:col-span-2">
                            <label
                                class="block text-xs font-semibold text-app-textMuted uppercase tracking-wider mb-2">Código
                                de Barras</label>
                            <div class="flex gap-2 mb-2">
                                <input type="text" id="f-codigo"
                                    class="flex-1 px-4 py-3 bg-app-bg border border-app-accent rounded-xl text-white font-mono focus:outline-none focus:border-app-primary focus:ring-1 focus:ring-app-primary transition"
                                    placeholder="Escanear o ingresar manual (Opcional)">
                                <button type="button" onclick="iniciarEscaner()" id="btn-escaner"
                                    class="px-4 py-3 bg-app-bg border border-app-accent rounded-xl text-app-textMuted hover:text-white hover:border-app-primary transition-colors flex items-center gap-2 tooltip"
                                    title="Escanear con Cámara">
                                    📷 <span class="hidden sm:inline text-xs">Escanear</span>
                                </button>
                            </div>
                            <div id="reader-container"
                                class="hidden w-full overflow-hidden rounded-xl border border-app-primary/50 relative bg-black">
                                <button type="button" onclick="detenerEscaner()"
                                    class="absolute top-2 right-2 z-10 bg-red-500 text-white p-1 rounded-lg text-xs font-bold hover:bg-red-600">Cerrar</button>
                                <div id="reader" class="w-full"></div>
                            </div>
                        </div>

                        <div class="md:col-span-2">
                            <label
                                class="block text-xs font-semibold text-app-textMuted uppercase tracking-wider mb-2">Descripción</label>
                            <textarea id="f-descripcion" rows="2"
                                class="w-full px-4 py-3 bg-app-bg border border-app-accent rounded-xl text-white focus:outline-none focus:border-app-primary focus:ring-1 focus:ring-app-primary transition resize-none"
                                placeholder="Anotaciones extra..."></textarea>
                        </div>
                    </div>
                </form>
            </div>

            <div class="p-4 border-t border-app-accent/50 bg-app-bg/50 rounded-b-2xl flex gap-3">
                <button type="button" onclick="cerrarModal()"
                    class="flex-1 px-4 py-3 border border-app-accent bg-app-card text-app-textMuted rounded-xl font-medium hover:bg-app-accent/50 hover:text-white transition-colors">
                    Cancelar
                </button>
                <button type="button" onclick="guardarProducto()"
                    class="flex-[2] bg-app-primary hover:bg-app-primaryHover text-slate-900 py-3 px-6 rounded-xl font-bold shadow-lg shadow-app-primary/20 transition-all flex justify-center items-center gap-2">
                    <span id="btn-texto">Guardar Producto</span>
                </button>
            </div>
        </div>
    </div>

    <style>
        /* Custom Scrollbar for Modal content */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #334155;
            border-radius: 3px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #475569;
        }
    </style>
@endsection

@push('scripts')
    <script src="https://unpkg.com/html5-qrcode"></script>
    <script>
        let productoEditandoId = null;
        let html5QrcodeScanner = null;

        function abrirModal() {
            productoEditandoId = null;
            document.getElementById('modal-titulo').innerHTML = '<span class="text-app-primary">✨</span> Nuevo Producto';
            document.getElementById('btn-texto').textContent = 'Crear Producto';
            document.getElementById('producto-form').reset();
            document.getElementById('producto-id').value = '';
            document.getElementById('suma-stock-container').classList.add('hidden');
            document.getElementById('f-stock').readOnly = false;
            document.getElementById('f-stock').classList.remove('opacity-50');
            document.getElementById('f-stock').classList.add('bg-app-bg');

            const modal = document.getElementById('producto-modal');
            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.classList.remove('opacity-0');
                document.getElementById('modal-content').classList.remove('scale-95');
                document.getElementById('f-nombre').focus();
            }, 10);
        }

        function editarProducto(producto) {
            productoEditandoId = producto.id;
            document.getElementById('modal-titulo').innerHTML = '<span class="text-amber-500">✏️</span> Editar Producto';
            document.getElementById('btn-texto').textContent = 'Guardar Cambios';
            document.getElementById('producto-id').value = producto.id;
            document.getElementById('f-nombre').value = producto.nombre;
            document.getElementById('f-precio').value = producto.precio;
            document.getElementById('f-precio-compra').value = producto.precio_compra ?? '';
            document.getElementById('f-precio-caja').value = producto.precio_caja ?? '';
            document.getElementById('f-precio-venta-caja').value = producto.precio_venta_caja ?? '';
            document.getElementById('f-stock').value = producto.stock;
            document.getElementById('f-stock').readOnly = true;
            document.getElementById('f-stock').classList.add('opacity-50', 'bg-app-bg');
            document.getElementById('f-suma-stock').value = 0;
            document.getElementById('suma-stock-container').classList.remove('hidden');
            document.getElementById('f-categoria').value = producto.categoria;
            document.getElementById('f-codigo').value = producto.codigo_barras ?? '';
            document.getElementById('f-descripcion').value = producto.descripcion ?? '';
            document.getElementById('f-cantidad-caja').value = producto.cantidad_caja ?? '';

            const modal = document.getElementById('producto-modal');
            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.classList.remove('opacity-0');
                document.getElementById('modal-content').classList.remove('scale-95');
            }, 10);
        }

        function cerrarModal() {
            detenerEscaner(); // Asegurarse de apagar la cámara al cerrar
            const modal = document.getElementById('producto-modal');
            modal.classList.add('opacity-0');
            document.getElementById('modal-content').classList.add('scale-95');
            setTimeout(() => {
                modal.classList.add('hidden');
                document.getElementById('form-messages').innerHTML = '';
                productoEditandoId = null;
            }, 300);
        }

        // Lógica de Escáner de Código de Barras
        function iniciarEscaner() {
            const container = document.getElementById('reader-container');
            const btnEscaner = document.getElementById('btn-escaner');

            if (!container.classList.contains('hidden')) {
                detenerEscaner();
                return;
            }

            container.classList.remove('hidden');
            btnEscaner.classList.add('bg-app-primary/20', 'text-app-primary', 'border-app-primary');

            html5QrcodeScanner = new Html5Qrcode("reader");

            const config = {
                fps: 10,
                qrbox: {
                    width: 250,
                    height: 150
                },
                aspectRatio: 1.0
            };

            html5QrcodeScanner.start({
                facingMode: "environment"
            }, config,
                (decodedText, decodedResult) => {
                    // Éxito al leer
                    document.getElementById('f-codigo').value = decodedText;
                    mostrarMsgForm('Código de barras detectado exitosamente', 'exito');
                    // Hacer un pequeño pitido (opcional)
                    try {
                        const ctx = new (window.AudioContext || window.webkitAudioContext)();
                        if (ctx) {
                            const osc = ctx.createOscillator();
                            osc.connect(ctx.destination);
                            osc.frequency.value = 800;
                            osc.start();
                            setTimeout(() => osc.stop(), 100);
                        }
                    } catch (e) { }
                    detenerEscaner();
                },
                (errorMessage) => {
                    // parse error, do nothing
                }
            ).catch((err) => {
                mostrarMsgForm('Error accediendo a la cámara. Revisa los permisos del navegador.', 'error');
                detenerEscaner();
            });
        }

        function detenerEscaner() {
            const container = document.getElementById('reader-container');
            const btnEscaner = document.getElementById('btn-escaner');

            if (html5QrcodeScanner && html5QrcodeScanner.isScanning) {
                html5QrcodeScanner.stop().then(() => {
                    html5QrcodeScanner.clear();
                }).catch(err => console.log("Failed to stop scanning.", err));
            }

            container.classList.add('hidden');
            btnEscaner.classList.remove('bg-app-primary/20', 'text-app-primary', 'border-app-primary');
        }

        async function guardarProducto() {
    const nombre = document.getElementById('f-nombre').value.trim();
    const precio = parseFloat(document.getElementById('f-precio').value);

    if (!nombre || isNaN(precio) || precio <= 0) {
        mostrarMsgForm('Validación: Nombre y precio válido son requeridos', 'error');
        return;
    }

    const btnTextOriginal = document.getElementById('btn-texto').textContent;
    document.getElementById('btn-texto').innerHTML = 'Guardando <span class="animate-pulse">...</span>';

    // ACTUALIZACIÓN AQUÍ:
    const data = {
        nombre,
        precio,
        precio_compra: parseFloat(document.getElementById('f-precio-compra').value) || 0,
        precio_caja: parseFloat(document.getElementById('f-precio-caja').value) || 0,
        precio_venta_caja: parseFloat(document.getElementById('f-precio-venta-caja').value) || 0,
        stock: parseInt(document.getElementById('f-stock').value) || 0,
        suma_stock: parseInt(document.getElementById('f-suma-stock').value) || 0,
        cantidad_caja: parseInt(document.getElementById('f-cantidad-caja').value) || null,
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
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify(data)
        });

        let result;
        try {
            result = await res.json();
        } catch (parseError) {
            mostrarMsgForm('Error inesperado del servidor (respuesta inválida)', 'error');
            document.getElementById('btn-texto').textContent = btnTextOriginal;
            return;
        }

        if (res.ok && result.success) {
            mostrarToast(productoEditandoId ? 'Producto actualizado' : 'Producto registrado exitosamente', 'exito');
            cerrarModal();
            setTimeout(() => location.reload(), 800);
        } else if (res.status === 422 && result.errors) {
            const primerError = Object.values(result.errors)[0][0];
            mostrarMsgForm(primerError, 'error');
            document.getElementById('btn-texto').textContent = btnTextOriginal;
        } else {
            mostrarMsgForm(result.message ?? 'Error al guardar en base de datos', 'error');
            document.getElementById('btn-texto').textContent = btnTextOriginal;
        }
    } catch (e) {
        mostrarMsgForm('Error de conexión de red', 'error');
        document.getElementById('btn-texto').textContent = btnTextOriginal;
    }
}

        async function desactivarProducto(id) {
            if (!confirm('¿Seguro que deseas desactivar este producto del inventario?')) return;

            try {
                const res = await fetch(`/productos/${id}/desactivar`, {
                    method: 'PATCH',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });
                const data = await res.json();
                if (data.success) {
                    document.getElementById(`prod-${id}`)?.classList.add('opacity-0', '-translate-x-full');
                    setTimeout(() => document.getElementById(`prod-${id}`)?.remove(), 300);
                    mostrarToast('Producto archivado/desactivado', 'exito');
                }
            } catch (e) {
                mostrarToast('Error al desactivar el producto', 'error');
            }
        }

        async function activarProducto(id) {
            try {
                const res = await fetch(`/productos/${id}/activar`, {
                    method: 'PATCH',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });
                const data = await res.json();
                if (data.success) {
                    mostrarToast('Producto nuevamente activo', 'exito');
                    filtrarProductos();
                }
            } catch (e) {
                mostrarToast('Error al activar', 'error');
            }
        }

        let filterTimeout = null;

        function filtrarProductos() {
            if (filterTimeout) clearTimeout(filterTimeout);

            // Add small local loading state
            const tbody = document.getElementById('productos-list');
            tbody.style.opacity = '0.5';

            filterTimeout = setTimeout(async () => {
                const params = new URLSearchParams({
                    buscar: document.getElementById('buscar-producto').value,
                    categoria: document.getElementById('filtro-categoria').value,
                    stock: document.getElementById('filtro-stock').value,
                    estado: document.getElementById('filtro-estado').value,
                });

                try {
                    const res = await fetch(`/productos/filtrar?${params}`);
                    const productos = await res.json();

                    tbody.style.opacity = '1';

                    if (productos.length === 0) {
                        tbody.innerHTML = `
                        <tr><td colspan="6" class="px-6 py-16 text-center text-app-textMuted bg-app-bg/20">
                            <div class="text-5xl mb-4 opacity-30">🔍</div>
                            <p class="text-sm">No hay resultados para esta búsqueda</p>
                        </td></tr>`;
                        return;
                    }

                    tbody.innerHTML = productos.map(p => {
                        const isBajo = p.stock <= 5;
                        const stockClasses = isBajo ? 'text-red-400 bg-red-400/10 px-2 py-0.5 rounded' :
                            'text-emerald-400';

                        return `
                        <tr class="hover:bg-app-bg/50 transition-colors group ${p.activo ? '' : 'opacity-60 bg-red-500/5'}" id="prod-${p.id}">
                            <td class="px-6 py-4">
                                <div class="font-semibold text-white group-hover:text-app-primary transition-colors">${p.nombre}</div>
                                ${p.codigo_barras ? `<div class="text-xs text-app-textMuted/70 mt-1 font-mono bg-app-bg inline-block px-2 py-0.5 rounded border border-app-accent/50">${p.codigo_barras}</div>` : ''}
                            </td>
                            <td class="px-6 py-4">
                                <span class="bg-indigo-500/10 text-indigo-400 border border-indigo-500/20 text-xs px-2.5 py-1 rounded-lg">${p.categoria}</span>
                            </td>
                            <td class="px-6 py-4 font-medium text-white">$${parseFloat(p.precio).toFixed(2)}</td>
                            <td class="px-6 py-4">
                                <span class="font-bold inline-block text-center min-w-[30px] ${stockClasses}">${p.stock}</span>
                            </td>
                            <td class="px-6 py-4 text-app-textMuted hidden md:table-cell">$${(parseFloat(p.precio) * p.stock).toFixed(2)}</td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center gap-2">
                                    <button onclick='editarProducto(${JSON.stringify(p)})' 
                                        class="bg-amber-500/10 hover:bg-amber-500 hover:text-white text-amber-500 border border-amber-500/20 px-3 py-1.5 rounded-lg text-xs font-semibold transition-all">Editar</button>
                                    ${p.activo
                                ? `<button onclick="desactivarProducto('${p.id}')" class="bg-red-500/10 hover:bg-red-500 hover:text-white text-red-500 border border-red-500/20 px-3 py-1.5 rounded-lg text-xs font-semibold transition-all">Desactivar</button>`
                                : `<button onclick="activarProducto('${p.id}')" class="bg-emerald-500/10 hover:bg-emerald-500 hover:text-white text-emerald-500 border border-emerald-500/20 px-3 py-1.5 rounded-lg text-xs font-semibold transition-all">Activar</button>`
                            }
                                </div>
                            </td>
                        </tr>
                    `;
                    }).join('');
                } catch (e) {
                    tbody.style.opacity = '1';
                    mostrarToast('Error filtrando listado', 'error');
                }
            }, 400); // debounce 400ms
        }

        function mostrarMsgForm(msg, tipo) {
            const isError = tipo === 'error';
            document.getElementById('form-messages').innerHTML = `
            <div class="flex items-center gap-3 p-4 rounded-xl text-sm font-medium ${isError ? 'bg-red-500/10 text-red-400 border border-red-500/30' : 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/30'}">
                <span class="text-xl">${isError ? '❌' : '✅'}</span>
                ${msg}
            </div>`;
            setTimeout(() => document.getElementById('form-messages').innerHTML = '', 5000);
        }

        function mostrarToast(msg, tipo) {
            const isExito = tipo === 'exito';
            const div = document.createElement('div');
            div.className =
                `fixed bottom-6 right-6 transform transition-all duration-300 translate-y-10 opacity-0 px-6 py-4 rounded-xl shadow-2xl z-[100] border font-medium flex items-center gap-3 ${isExito ? 'bg-emerald-500 text-white border-emerald-400' : 'bg-red-500 text-white border-red-400'}`;
            div.innerHTML = `<span class="text-xl bg-white/20 p-1 rounded-lg">${isExito ? '✅' : '⚠️'}</span> ${msg}`;

            document.body.appendChild(div);

            // Animate in
            setTimeout(() => {
                div.classList.remove('translate-y-10', 'opacity-0');
            }, 50);

            // Remove element
            setTimeout(() => {
                div.classList.add('translate-y-10', 'opacity-0');
                setTimeout(() => div.remove(), 300);
            }, 3500);
        }

        // Hover cards detail logic
        let stockCargado = false;
        let categoriasCargadas = false;

        async function mostrarDetallesStock() {
            if (stockCargado) return;
            const lista = document.getElementById('lista-hover-stock');

            try {
                const res = await fetch('/productos/filtrar?stock=bajo');
                const productos = await res.json();

                if (productos.length === 0) {
                    lista.innerHTML =
                        '<li class="text-emerald-500 font-medium bg-emerald-500/10 p-2 rounded-lg text-center">Todo en orden ✅</li>';
                } else {
                    lista.innerHTML = productos.map(p => `
                    <li class="flex justify-between items-center py-1.5 border-b border-app-accent/30 last:border-0 hover:bg-app-bg px-2 rounded -mx-2">
                        <span class="truncate pr-2">${p.nombre}</span>
                        <span class="font-bold text-red-400 bg-red-400/10 px-2 rounded py-0.5 text-xs">${p.stock}</span>
                    </li>
                `).join('');
                }
                stockCargado = true;
            } catch (e) {
                lista.innerHTML = '<li class="text-red-400 text-xs">Error cargar BD</li>';
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
                <li class="flex justify-between items-center py-1.5 hover:bg-app-bg px-2 rounded -mx-2 transition-colors border-b border-app-accent/30 last:border-0">
                    <div class="flex items-center gap-2">
                        <span class="w-1.5 h-1.5 bg-indigo-500 rounded-full shadow-[0_0_8px_rgba(99,102,241,0.8)]"></span>
                        <span class="font-medium">${c}</span>
                    </div>
                    <span class="text-xs text-app-textMuted bg-app-bg px-2 rounded-lg">${productos.filter(p => p.categoria === c).length}</span>
                </li>
            `).join('');
                categoriasCargadas = true;
            } catch (e) {
                lista.innerHTML = '<li class="text-red-400 text-xs">Error de conexión</li>';
            }
        }
    </script>
@endpush
