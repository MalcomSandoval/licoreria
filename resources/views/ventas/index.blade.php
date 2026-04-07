@extends('layouts.app')

@section('title', 'Ventas')

@section('content')
<div class="space-y-8 animate-fade-in">

    {{-- Encabezado --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h1 class="text-3xl font-bold text-white flex items-center gap-3">
                <span class="p-2 bg-emerald-500/20 rounded-xl text-emerald-500">💳</span>
                Gestión de Ventas
            </h1>
            <p class="text-app-textMuted mt-1 ml-14">Registra nuevas ventas y administra tu historial</p>
        </div>
        <div class="ml-14 md:ml-0">
            <button onclick="toggleFormulario()"
                class="bg-emerald-500 hover:bg-emerald-400 text-slate-900 px-6 py-2.5 rounded-xl font-bold transition-all hover:scale-105 hover:shadow-[0_0_20px_rgba(16,185,129,0.4)] flex items-center justify-center gap-2 shadow-lg focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                <span class="text-xl leading-none">+</span> <span id="toggle-text">Nueva Venta</span>
            </button>
        </div>
    </div>

    {{-- Estadísticas Rápidas --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6">
        <div class="bg-app-card rounded-2xl shadow-lg border border-app-accent/50 p-5 hover:border-emerald-500/50 transition-colors group">
            <h3 class="text-app-textMuted text-xs font-semibold uppercase tracking-wider mb-2">Ventas Hoy</h3>
            <div class="flex items-end justify-between">
                <p class="text-2xl sm:text-3xl font-bold text-white group-hover:text-emerald-400 transition-colors">${{ number_format($ventasHoy, 2) }}</p>
                <div class="text-emerald-400/50 group-hover:text-emerald-400 transition-colors hidden sm:block">
                    <svg class="w-6 h-6 sm:w-8 sm:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
        </div>

        <div class="bg-app-card rounded-2xl shadow-lg border border-app-accent/50 p-5 hover:border-indigo-500/50 transition-colors group">
            <h3 class="text-app-textMuted text-xs font-semibold uppercase tracking-wider mb-2">Promedio Venta</h3>
            <div class="flex items-end justify-between">
                <p class="text-2xl sm:text-3xl font-bold text-white group-hover:text-indigo-400 transition-colors">${{ number_format($promedioHoy, 2) }}</p>
                <div class="text-indigo-400/50 group-hover:text-indigo-400 transition-colors hidden sm:block">
                    <svg class="w-6 h-6 sm:w-8 sm:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                </div>
            </div>
        </div>

        <div class="bg-app-card rounded-2xl shadow-lg border border-app-accent/50 p-5 hover:border-amber-500/50 transition-colors group">
            <h3 class="text-app-textMuted text-xs font-semibold uppercase tracking-wider mb-2">Método Popular</h3>
            <div class="flex items-end justify-between">
                <p class="text-xl sm:text-2xl font-bold text-white group-hover:text-amber-400 transition-colors capitalize">{{ $metodoPopular }}</p>
                <div class="text-amber-400/50 group-hover:text-amber-400 transition-colors hidden sm:block">
                    <svg class="w-6 h-6 sm:w-8 sm:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                </div>
            </div>
        </div>

        <div class="bg-app-card rounded-2xl shadow-lg border border-app-accent/50 p-5 hover:border-blue-500/50 transition-colors group">
            <h3 class="text-app-textMuted text-xs font-semibold uppercase tracking-wider mb-2">Facturas Hoy</h3>
            <div class="flex items-end justify-between">
                <p class="text-2xl sm:text-3xl font-bold text-white group-hover:text-blue-400 transition-colors">{{ $cantidadHoy }}</p>
                <div class="text-blue-400/50 group-hover:text-blue-400 transition-colors hidden sm:block">
                    <svg class="w-6 h-6 sm:w-8 sm:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                </div>
            </div>
        </div>
    </div>

    {{-- Formulario de Nueva Venta (Oculto por defecto) --}}
    <div id="venta-form-container" class="hidden relative">
        <div class="absolute inset-0 bg-gradient-to-br from-emerald-500/5 to-indigo-500/5 rounded-2xl pointer-events-none"></div>
        <div class="bg-app-card rounded-2xl shadow-lg border border-emerald-500/30 p-6 sm:p-8 relative z-10">
            <div class="flex justify-between items-center mb-6 pb-4 border-b border-app-accent/50">
                <h3 class="text-xl font-bold text-emerald-400 flex items-center gap-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    Terminal de Venta
                </h3>
                <button onclick="toggleFormulario()" class="text-app-textMuted hover:text-white transition-colors bg-app-bg p-1.5 rounded-lg border border-app-accent">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <div id="venta-messages"></div>

            {{-- Buscador de productos --}}
            <div class="mb-8 p-4 sm:p-6 bg-app-bg rounded-xl border border-app-accent/50 shadow-inner">
                <h4 class="text-sm font-semibold text-app-textMuted uppercase tracking-wider mb-4">Agregar Producto</h4>
                <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
                    <div class="md:col-span-8 relative">
                        <label class="block text-xs text-app-textMuted mb-2">Buscar (Nombre o Código)</label>
                        <div class="relative">
                            <input type="text" id="buscar-producto"
                                placeholder="Coca Cola, Aguardiente..."
                                oninput="filtrarProductos(this.value)"
                                autocomplete="off"
                                class="w-full pl-10 pr-4 py-3 bg-app-card border border-app-accent rounded-xl text-white focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition shadow-sm">
                            <span class="absolute left-3 top-3.5 text-app-textMuted">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </span>
                        </div>
                        <div id="productos-sugerencias"
                            class="absolute z-[60] left-0 right-0 max-w-full bg-app-card border border-emerald-500/50 rounded-xl mt-2 max-h-60 overflow-y-auto shadow-2xl hidden">
                        </div>
                    </div>
                    
                    <div class="md:col-span-2">
                        <label class="block text-xs text-app-textMuted mb-2">Cantidad</label>
                        <input type="number" id="cantidad-producto" min="1" value="1"
                            class="w-full px-4 py-3 bg-app-card border border-app-accent rounded-xl text-whitetext-center focus:outline-none focus:border-emerald-500 transition shadow-sm"
                            placeholder="Qty">
                    </div>
                    
                    <div class="md:col-span-2">
                        <button type="button" onclick="agregarAlCarrito()"
                            class="w-full bg-emerald-500/20 hover:bg-emerald-500 text-emerald-400 hover:text-white border border-emerald-500/50 py-3 px-4 rounded-xl font-bold transition-all shadow-sm flex justify-center items-center h-[50px]">
                            Añadir <span class="hidden sm:inline ml-1">↓</span>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Carrito --}}
            <div id="carrito-container" class="mb-8 hidden animate-fade-in">
                <div class="bg-app-bg border border-app-accent/50 rounded-xl overflow-hidden shadow-inner">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-app-card text-app-textMuted text-xs uppercase tracking-wider border-b border-app-accent">
                                    <th class="px-4 py-3 text-left font-semibold">Producto</th>
                                    <th class="px-4 py-3 text-left font-semibold">Precio</th>
                                    <th class="px-4 py-3 text-center font-semibold text-white">Cantidad</th>
                                    <th class="px-4 py-3 text-right font-semibold">Subtotal</th>
                                    <th class="px-4 py-3 text-center w-16"></th>
                                </tr>
                            </thead>
                            <tbody id="carrito-items" class="divide-y divide-app-accent/30 text-sm"></tbody>
                            <tfoot>
                                <tr class="bg-emerald-500/10 border-t border-emerald-500/30">
                                    <td colspan="3" class="px-4 py-5 font-bold text-right text-emerald-100 uppercase tracking-widest text-sm">Total a pagar:</td>
                                    <td class="px-4 py-5 font-bold text-2xl text-emerald-400 text-right" id="total-carrito">$0.00</td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Checkout Footer --}}
            <div class="flex flex-col sm:flex-row gap-6 items-end bg-app-bg/50 p-6 rounded-xl border border-app-accent/30 mt-6 pt-6">
                <div class="flex-1 w-full">
                    <label class="block text-xs font-semibold text-app-textMuted uppercase tracking-wider mb-2">Método de Pago</label>
                    <select id="metodo-pago"
                        class="w-full lg:max-w-xs px-4 py-3.5 bg-app-card border border-app-accent rounded-xl text-white focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition appearance-none">
                        <option value="efectivo">💵 Efectivo</option>
                        <option value="tarjeta">💳 Tarjeta (Datáfono)</option>
                        <option value="transferencia">🏦 Transferencia / Nequi</option>
                    </select>
                </div>
                <button onclick="procesarVenta()"
                    class="w-full sm:w-auto bg-emerald-500 hover:bg-emerald-400 text-slate-900 px-8 py-3.5 rounded-xl font-bold text-lg transition-all hover:-translate-y-1 shadow-[0_0_20px_rgba(16,185,129,0.3)] hover:shadow-[0_0_25px_rgba(16,185,129,0.5)] flex items-center justify-center gap-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    Procesar Cobro
                </button>
            </div>
        </div>
    </div>

    {{-- Historial de Ventas --}}
    <div class="bg-app-card rounded-2xl shadow-lg border border-app-accent/50 overflow-hidden">
        <div class="px-6 py-5 border-b border-app-accent/50 flex flex-col md:flex-row justify-between items-start md:items-center gap-4 bg-app-bg">
            <h3 class="text-lg font-bold text-white flex items-center gap-2">
                <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                Historial de Registro
            </h3>
            
            <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <span class="text-app-textMuted text-xs">💸</span>
                    </div>
                    <select id="filtro-metodo" onchange="filtrarVentas()"
                        class="w-full pl-8 pr-8 py-2 bg-app-card border border-app-accent rounded-lg text-sm text-white focus:outline-none focus:border-indigo-500 appearance-none">
                        <option value="">Todos los métodos</option>
                        <option value="efectivo">Efectivo</option>
                        <option value="tarjeta">Tarjeta</option>
                        <option value="transferencia">Transferencia</option>
                    </select>
                </div>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-app-textMuted">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <input type="date" id="filtro-fecha" onchange="filtrarVentas()"
                        class="w-full pl-9 pr-4 py-2 bg-app-card border border-app-accent rounded-lg text-sm text-white focus:outline-none focus:border-indigo-500 hover:cursor-pointer [color-scheme:dark]">
                </div>
            </div>
        </div>
        
        <div class="overflow-x-auto min-h-[300px]">
            <table class="w-full text-left">
                <thead class="bg-app-card text-app-textMuted text-xs uppercase tracking-wider border-b border-app-accent/50">
                    <tr>
                        <th class="px-6 py-4 font-semibold">ID / Fecha</th>
                        <th class="px-6 py-4 font-semibold text-right">Monto Total</th>
                        <th class="px-6 py-4 font-semibold text-center">Método</th>
                        <th class="px-6 py-4 font-semibold text-center hidden sm:table-cell">Productos</th>
                        <th class="px-6 py-4 font-semibold text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody id="ventas-list" class="divide-y divide-app-accent/30 text-sm">
                    @forelse($ventas as $venta)
                    <tr class="hover:bg-app-bg/50 transition-colors group cursor-default" id="venta-{{ $venta->id }}">
                        <td class="px-6 py-4">
                            <div class="text-xs text-app-textMuted font-mono bg-app-bg inline-block px-1.5 py-0.5 rounded border border-app-accent/30 mb-1">#{{ substr($venta->id, 0, 8) }}</div>
                            <div class="text-white font-medium">{{ $venta->fecha_venta->format('d/m/Y h:i A') }}</div>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <span class="font-bold text-emerald-400 text-base">${{ number_format($venta->total, 2) }}</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if($venta->metodo_pago == 'efectivo')
                                <span class="bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 px-2 py-1 rounded text-xs capitalize flex justify-center items-center gap-1 w-max mx-auto"><span>💵</span> Efectivo</span>
                            @elseif($venta->metodo_pago == 'tarjeta')
                                <span class="bg-blue-500/10 text-blue-400 border border-blue-500/20 px-2 py-1 rounded text-xs capitalize flex justify-center items-center gap-1 w-max mx-auto"><span>💳</span> Tarjeta</span>
                            @else
                                <span class="bg-indigo-500/10 text-indigo-400 border border-indigo-500/20 px-2 py-1 rounded text-xs capitalize flex justify-center items-center gap-1 w-max mx-auto"><span>🏦</span> Transferencia</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center hidden sm:table-cell">
                            <span class="text-white font-medium bg-app-bg px-2.5 py-1 rounded-lg border border-app-accent">{{ $venta->detalles->count() }}</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex justify-center gap-2">
                                <button onclick="verDetalle('{{ $venta->id }}')"
                                    class="bg-indigo-500/10 hover:bg-indigo-500 hover:text-white text-indigo-400 border border-indigo-500/20 p-2 rounded-lg text-xs font-semibold transition-all tooltip" title="Ver Detalles">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </button>
                                <button onclick="eliminarVenta('{{ $venta->id }}')"
                                    class="bg-red-500/10 hover:bg-red-500 hover:text-white text-red-500 border border-red-500/20 p-2 rounded-lg text-xs font-semibold transition-all tooltip" title="Anular Venta">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-16 text-center text-app-textMuted bg-app-bg/20">
                            <div class="text-5xl mb-4 opacity-50">🛒</div>
                            <p class="text-lg">No hay ventas registradas aún</p>
                            <p class="text-sm mt-1 opacity-70">Haz clic en Nueva Venta para empezar facturación.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Modal detalle visual premium --}}
<div id="modal-detalle" class="fixed inset-0 bg-app-bg/80 backdrop-blur-sm flex items-center justify-center p-4 z-50 hidden opacity-0 transition-opacity duration-300">
    <div class="bg-app-card rounded-2xl shadow-[0_0_40px_rgba(0,0,0,0.5)] border border-app-accent w-full max-w-lg max-h-[85vh] flex flex-col transform scale-95 transition-transform duration-300" id="modal-detalle-content">
        
        <div class="p-5 border-b border-app-accent/50 flex justify-between items-center bg-app-bg rounded-t-2xl relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-indigo-500/10 to-transparent pointer-events-none"></div>
            <h3 class="text-lg font-bold text-white flex items-center gap-2 relative z-10">
                <span class="text-indigo-400">📄</span> Recibo de Venta
            </h3>
            <button onclick="cerrarModal()" class="text-app-textMuted hover:text-white transition-colors p-1.5 bg-app-card rounded-lg border border-app-accent hover:bg-red-500/20 hover:border-red-500/50 relative z-10">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
        
        <div class="p-6 overflow-y-auto custom-scrollbar" id="modal-contenido">
            <!-- Renderizado dinámico desde JS -->
        </div>
        
        <div class="p-4 border-t border-app-accent/50 bg-app-bg/50 rounded-b-2xl flex justify-center">
            <button onclick="imprimirRecibo()" class="px-6 py-2.5 bg-app-card border border-app-accent text-white font-medium rounded-xl hover:text-indigo-400 hover:border-indigo-400/50 transition-colors flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                Imprimir Copia
            </button>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    const productosDisponibles = @json($productos);
    let carrito = [];
    let productoSeleccionado = null;
    let formVisible = false;

    function toggleFormulario() {
        formVisible = !formVisible;
        const container = document.getElementById('venta-form-container');
        if (formVisible) {
            container.classList.remove('hidden');
            setTimeout(() => {
                document.getElementById('buscar-producto').focus();
            }, 100);
        } else {
            container.classList.add('hidden');
        }
        document.getElementById('toggle-text').textContent = formVisible ? 'Ocultar Terminal' : 'Nueva Venta';
    }

    function filtrarProductos(query) {
        const sugerencias = document.getElementById('productos-sugerencias');
        if (!query.trim()) { sugerencias.classList.add('hidden'); return; }

        const filtrados = productosDisponibles
            .filter(p => (p.nombre.toLowerCase().includes(query.toLowerCase()) || p.codigo_barras?.includes(query)) && p.activo)
            .slice(0, 10);

        if (filtrados.length === 0) { 
            sugerencias.innerHTML = `<div class="px-4 py-3 text-app-textMuted text-sm text-center">No se encontraron productos activos</div>`;
            sugerencias.classList.remove('hidden'); 
            return; 
        }

        sugerencias.innerHTML = filtrados.map(p => `
            <button type="button" onclick="seleccionarProducto(${JSON.stringify(p).replace(/"/g, '&quot;')})"
                class="w-full px-4 py-3 text-left hover:bg-app-bg border-b border-app-accent/50 last:border-b-0 transition flex justify-between items-center group">
                <div>
                    <div class="font-medium text-white group-hover:text-emerald-400 transition-colors">${p.nombre}</div>
                    <div class="text-xs text-app-textMuted mt-1">Stock disponible: <span class="${p.stock <= 5 ? 'text-red-400' : 'text-emerald-400'} font-semibold">${p.stock}</span></div>
                </div>
                <div class="text-emerald-400 font-bold">$${parseFloat(p.precio).toFixed(2)}</div>
            </button>
        `).join('');
        sugerencias.classList.remove('hidden');
    }

    function seleccionarProducto(producto) {
        productoSeleccionado = producto;
        document.getElementById('buscar-producto').value = producto.nombre;
        document.getElementById('productos-sugerencias').classList.add('hidden');
        document.getElementById('cantidad-producto').focus();
    }

    function agregarAlCarrito() {
        if (!productoSeleccionado) { mostrarToast('Debe buscar y elegir un producto', 'error'); return; }
        const cantidad = parseInt(document.getElementById('cantidad-producto').value);
        if (cantidad <= 0 || isNaN(cantidad)) { mostrarToast('Cantidad inválida', 'error'); return; }
        if (cantidad > productoSeleccionado.stock) {
            mostrarToast(`Stock insuficiente (Hay ${productoSeleccionado.stock})`, 'error'); return;
        }

        const existente = carrito.find(i => i.producto_id === productoSeleccionado.id);
        if (existente) {
            const nueva = existente.cantidad + cantidad;
            if (nueva > productoSeleccionado.stock) {
                mostrarToast(`La suma supera el stock (${productoSeleccionado.stock})`, 'error'); return;
            }
            existente.cantidad = nueva;
            existente.subtotal = nueva * existente.precio_unitario;
        } else {
            carrito.push({
                producto_id:    productoSeleccionado.id,
                nombre:         productoSeleccionado.nombre,
                precio_unitario: parseFloat(productoSeleccionado.precio),
                precio_compra:   parseFloat(productoSeleccionado.precio_compra ?? 0), // guardar para cálculo de utilidad
                cantidad:       cantidad,
                subtotal:       cantidad * parseFloat(productoSeleccionado.precio)
            });
        }

        productoSeleccionado = null;
        document.getElementById('buscar-producto').value = '';
        document.getElementById('cantidad-producto').value = 1;
        document.getElementById('buscar-producto').focus();
        renderizarCarrito();
    }

    function removerItem(index) {
        carrito.splice(index, 1);
        renderizarCarrito();
    }

    function actualizarCantidad(index, valor) {
        const nueva = parseInt(valor);
        if (nueva <= 0 || isNaN(nueva)) { removerItem(index); return; }
        const producto = productosDisponibles.find(p => p.id === carrito[index].producto_id);
        if (nueva > producto.stock) {
            mostrarToast(`Límite de stock alcanzado (${producto.stock})`, 'error'); 
            renderizarCarrito(); // re-render para forzar el valor anterior en el input html
            return; 
        }
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
            <tr class="hover:bg-app-bg transition-colors">
                <td class="px-4 py-3 font-medium text-white">${item.nombre}</td>
                <td class="px-4 py-3 text-app-textMuted">$${item.precio_unitario.toFixed(2)}</td>
                <td class="px-4 py-3 text-center">
                    <input type="number" min="1" value="${item.cantidad}"
                        onchange="actualizarCantidad(${index}, this.value)"
                        class="w-16 px-1 py-1.5 bg-app-bg border border-app-accent rounded-lg text-white text-center focus:border-emerald-500 focus:outline-none focus:ring-1 focus:ring-emerald-500">
                </td>
                <td class="px-4 py-3 font-bold text-emerald-400 text-right">$${item.subtotal.toFixed(2)}</td>
                <td class="px-4 py-3 text-center">
                    <button onclick="removerItem(${index})" class="text-red-400 hover:text-red-300 p-1 rounded hover:bg-red-500/10 transition-colors tooltip" title="Quitar item">
                        <svg class="w-5 h-5 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    </button>
                </td>
            </tr>
        `).join('');

        document.getElementById('total-carrito').textContent = `$${total.toFixed(2)}`;
    }

    async function procesarVenta() {
        if (carrito.length === 0) { mostrarToast('El carrito está vacío', 'error'); return; }
        const metodo = document.getElementById('metodo-pago').value;

        // Deshabilitar botón temporalmente para evitar multi clic
        const btnText = event.currentTarget.innerHTML;
        event.currentTarget.innerHTML = "Procesando...";
        event.currentTarget.disabled = true;

        try {
            const response = await fetch('/ventas', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ metodo_pago: metodo, items: carrito })
            });

            const data = await response.json();
            if (data.success) {
                mostrarToast('¡Facturación completada con éxito!', 'exito');
                carrito = [];
                renderizarCarrito();
                setTimeout(() => location.reload(), 800);
            } else {
                mostrarToast(data.error || 'Error lógico al procesar', 'error');
                event.currentTarget.disabled = false;
                event.currentTarget.innerHTML = btnText;
            }
        } catch (e) {
            mostrarToast('Error de red al servidor', 'error');
            event.currentTarget.disabled = false;
            event.currentTarget.innerHTML = btnText;
        }
    }

    async function filtrarVentas() {
        const metodo = document.getElementById('filtro-metodo').value;
        const fecha  = document.getElementById('filtro-fecha').value;

        const params = new URLSearchParams();
        if (metodo) params.append('metodo_pago', metodo);
        if (fecha)  params.append('fecha', fecha);

        const tbody = document.getElementById('ventas-list');
        tbody.style.opacity = '0.5';

        try {
            const response = await fetch(`/ventas/filtrar?${params}`);
            const ventas = await response.json();
            tbody.style.opacity = '1';

            if (ventas.length === 0) {
                tbody.innerHTML = `<tr><td colspan="5" class="px-6 py-16 text-center text-app-textMuted bg-app-bg/20"><div class="text-4xl mb-4 opacity-30">🔍</div><p>No hay coincidencias en el historial</p></td></tr>`;
                return;
            }

            tbody.innerHTML = ventas.map(v => {
                let badgeMetodo = '';
                if(v.metodo_pago === 'efectivo') badgeMetodo = `<span class="bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 px-2 py-1 rounded text-xs capitalize flex justify-center items-center gap-1 w-max mx-auto"><span>💵</span> Efectivo</span>`;
                else if(v.metodo_pago === 'tarjeta') badgeMetodo = `<span class="bg-blue-500/10 text-blue-400 border border-blue-500/20 px-2 py-1 rounded text-xs capitalize flex justify-center items-center gap-1 w-max mx-auto"><span>💳</span> Tarjeta</span>`;
                else badgeMetodo = `<span class="bg-indigo-500/10 text-indigo-400 border border-indigo-500/20 px-2 py-1 rounded text-xs capitalize flex justify-center items-center gap-1 w-max mx-auto"><span>🏦</span> Transf.</span>`;

                return `
                <tr class="hover:bg-app-bg/50 transition-colors group cursor-default" id="venta-${v.id}">
                    <td class="px-6 py-4">
                        <div class="text-xs text-app-textMuted font-mono bg-app-bg inline-block px-1.5 py-0.5 rounded border border-app-accent/30 mb-1">#${v.id.substring(0,8)}</div>
                        <div class="text-white font-medium">${new Date(v.fecha_venta).toLocaleString('es-CO')}</div>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <span class="font-bold text-emerald-400 text-base">$${parseFloat(v.total).toFixed(2)}</span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        ${badgeMetodo}
                    </td>
                    <td class="px-6 py-4 text-center hidden sm:table-cell">
                        <span class="text-white font-medium bg-app-bg px-2.5 py-1 rounded-lg border border-app-accent">${v.detalles?.length ?? 0}</span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <div class="flex justify-center gap-2">
                            <button onclick="verDetalle('${v.id}')" class="bg-indigo-500/10 hover:bg-indigo-500 hover:text-white text-indigo-400 border border-indigo-500/20 p-2 rounded-lg text-xs font-semibold transition-all tooltip" title="Ver Detalles"> <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg> </button>
                            <button onclick="eliminarVenta('${v.id}')" class="bg-red-500/10 hover:bg-red-500 hover:text-white text-red-500 border border-red-500/20 p-2 rounded-lg text-xs font-semibold transition-all tooltip" title="Anular"> <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg> </button>
                        </div>
                    </td>
                </tr>
            `}).join('');
        } catch (e) {
            tbody.style.opacity = '1';
        }
    }

    function verDetalle(id) {
        fetch(`/ventas/${id}/detalle`)
            .then(r => r.json())
            .then(venta => {
                const detalles = venta.detalles?.map(d => `
                    <div class="flex justify-between items-center py-3 border-b border-app-accent/30 last:border-0 hover:bg-app-bg/50 px-2 rounded-lg transition-colors">
                        <div>
                            <div class="font-medium text-white">${d.producto?.nombre ?? 'Producto Desconocido'}</div>
                            <div class="text-xs text-app-textMuted mt-0.5"><span class="bg-app-accent/50 px-1 rounded">x${d.cantidad}</span> a $${parseFloat(d.precio_unitario).toFixed(2)}</div>
                        </div>
                        <div class="text-right">
                            <div class="font-bold text-white">$${parseFloat(d.subtotal).toFixed(2)}</div>
                        </div>
                    </div>
                `).join('') ?? '<p class="text-app-textMuted">Sin detalles registrados</p>';

                document.getElementById('modal-contenido').innerHTML = `
                    <div class="mb-6 bg-app-bg p-4 rounded-xl border border-app-accent">
                        <div class="text-center font-mono text-xs text-app-textMuted uppercase mb-3 border-b border-app-accent/50 pb-2">Ticket # ${venta.id}</div>
                        <div class="grid grid-cols-2 gap-4 text-sm mt-3">
                            <div><span class="text-app-textMuted text-xs block uppercase">Fecha y Hora</span><div class="font-medium text-white">${new Date(venta.fecha_venta).toLocaleString('es-CO')}</div></div>
                            <div><span class="text-app-textMuted text-xs block uppercase">Método Pago</span><div class="font-medium text-emerald-400 capitalize">${venta.metodo_pago}</div></div>
                        </div>
                    </div>
                    
                    <h4 class="font-semibold text-app-textMuted text-xs uppercase mb-3 px-2">Detalle de Compra</h4>
                    <div class="bg-app-bg border border-app-accent rounded-xl p-2 mb-6">
                        ${detalles}
                    </div>

                    <div class="bg-app-card border-t border-app-primary/30 p-4 -mx-6 -mb-6 pb-6 mt-4 flex justify-between items-center bg-gradient-to-r from-emerald-500/10 to-transparent">
                        <span class="text-lg text-app-textMuted font-bold">Total Pagar:</span>
                        <span class="text-3xl font-bold text-emerald-400 tracking-tight">$${parseFloat(venta.total).toFixed(2)}</span>
                    </div>
                `;
                
                const modal = document.getElementById('modal-detalle');
                modal.classList.remove('hidden');
                setTimeout(() => {
                    modal.classList.remove('opacity-0');
                    document.getElementById('modal-detalle-content').classList.remove('scale-95');
                }, 10);
            });
    }

    function cerrarModal() {
        const modal = document.getElementById('modal-detalle');
        modal.classList.add('opacity-0');
        document.getElementById('modal-detalle-content').classList.add('scale-95');
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }

    function imprimirRecibo() {
        window.print();
        // A un nivel más pro: se abriría una nueva ventana con solo the form content formateado para la ticketera 58mm y .print()
        mostrarToast('Enviado a impresora (Preview)', 'exito');
    }

    async function eliminarVenta(id) {
        if (!confirm('Esta acción anulará la venta en ingresos monetarios, pero no devuelve inventario (funcionalidad limitada actualmente). ¿Desea continuar?')) return;
        try {
            const response = await fetch(`/ventas/${id}`, {
                method: 'DELETE',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
            });
            const data = await response.json();
            if (data.success) {
                document.getElementById(`venta-${id}`)?.classList.add('opacity-0', 'bg-red-500/10');
                setTimeout(() => document.getElementById(`venta-${id}`)?.remove(), 300);
                mostrarToast('Ticket anulado del sistema', 'exito');
            }
        } catch(e) {
            mostrarToast('Error en la eliminación', 'error');
        }
    }

    function mostrarToast(msg, tipo) {
        const isExito = tipo === 'exito';
        const div = document.createElement('div');
        div.className = `fixed bottom-6 left-1/2 -translate-x-1/2 transform transition-all duration-300 translate-y-10 opacity-0 px-6 py-3 rounded-full shadow-2xl z-[100] border font-bold flex items-center gap-3 backdrop-blur-md ${isExito ? 'bg-emerald-500/90 text-white border-emerald-400' : 'bg-red-500/90 text-white border-red-400'}`;
        div.innerHTML = `<span class="text-xl bg-white/20 p-0.5 rounded-full">${isExito ? '✨' : '⚠️'}</span> ${msg}`;
        
        document.body.appendChild(div);
        
        setTimeout(() => { div.classList.remove('translate-y-10', 'opacity-0'); }, 50);
        setTimeout(() => {
            div.classList.add('translate-y-10', 'opacity-0');
            setTimeout(() => div.remove(), 300);
        }, 3500);
    }
</script>
<style>
/* Ocultar elementos en impresión para la funcion imprimirRecibo() */
@media print {
    body * { visibility: hidden; }
    #modal-contenido, #modal-contenido * { visibility: visible; }
    #modal-contenido { position: absolute; left: 0; top: 0; width: 100%; color: black !important; }
    #modal-contenido * { color: black !important; background: white !important; }
}
</style>
@endpush
