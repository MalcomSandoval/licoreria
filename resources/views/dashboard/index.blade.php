@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="space-y-8">

        {{-- Encabezado --}}
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-app-card p-6 rounded-2xl border border-app-accent/50 shadow-lg relative overflow-hidden">
            <!-- Ambient detail -->
            <div class="absolute -right-10 -top-10 w-40 h-40 bg-app-primary/10 rounded-full blur-3xl pointer-events-none"></div>
            
            <div>
                <h1 class="text-3xl font-bold text-white flex items-center gap-3">
                    <span class="p-2 bg-app-primary/20 rounded-xl text-app-primary">📊</span>
                    Vista General
                </h1>
                <p class="text-app-textMuted mt-1">Resumen en tiempo real del desempeño de tu negocio</p>
            </div>
            <div class="text-left sm:text-right bg-app-bg px-4 py-2 rounded-xl border border-app-accent/50">
                <div class="text-xs text-app-textMuted uppercase font-semibold tracking-wider">Última actualización</div>
                <div class="text-lg font-mono text-app-primary flex items-center gap-2" id="ultima-actualizacion">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    {{ now()->format('H:i:s') }}
                </div>
            </div>
        </div>

        {{-- Métricas principales --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

            <div class="bg-app-card rounded-2xl shadow-lg border border-app-accent/50 overflow-hidden group hover:border-emerald-500/50 transition-colors duration-300 relative">
                <div class="absolute bottom-0 left-0 h-1 bg-gradient-to-r from-emerald-400 to-emerald-600 transition-all duration-300 w-full group-hover:h-1.5 opacity-80"></div>
                <div class="p-6">
                    <div class="flex items-start justify-between">
                        <div>
                            <h3 class="text-app-textMuted text-xs font-semibold uppercase tracking-wider">Ventas Hoy</h3>
                            <p class="text-3xl font-bold text-white mt-1 group-hover:text-emerald-400 transition-colors">${{ number_format($ventasHoy, 2) }}</p>
                        </div>
                        <div class="p-3 bg-emerald-500/10 rounded-xl text-emerald-400">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                    </div>
                </div>
                <div class="bg-app-bg/50 px-6 py-3 border-t border-app-accent/50">
                    <span class="text-xs font-medium focus text-emerald-500 flex items-center gap-1">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"></path></svg>
                        {{ $cantidadHoy }} facturas concretadas
                    </span>
                </div>
            </div>

            <div class="bg-app-card rounded-2xl shadow-lg border border-app-accent/50 overflow-hidden group hover:border-app-primary/50 transition-colors duration-300 relative">
                <div class="absolute bottom-0 left-0 h-1 bg-gradient-to-r from-amber-400 to-amber-600 transition-all duration-300 w-full group-hover:h-1.5 opacity-80"></div>
                <div class="p-6">
                    <div class="flex items-start justify-between">
                        <div>
                            <h3 class="text-app-textMuted text-xs font-semibold uppercase tracking-wider">Productos</h3>
                            <p class="text-3xl font-bold text-white mt-1 group-hover:text-app-primary transition-colors">{{ $totalProductos }}</p>
                        </div>
                        <div class="p-3 bg-app-primary/10 rounded-xl text-app-primary">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                        </div>
                    </div>
                </div>
                <div class="bg-app-bg/50 px-6 py-3 border-t border-app-accent/50">
                    <span class="text-xs font-medium text-app-textMuted">{{ $productosActivos }} en estado <span class="text-emerald-500">activo</span></span>
                </div>
            </div>

            <div class="bg-app-card rounded-2xl shadow-lg border border-app-accent/50 overflow-hidden group hover:border-red-500/50 transition-colors duration-300 relative">
                <div class="absolute bottom-0 left-0 h-1 bg-gradient-to-r from-red-400 to-rose-600 transition-all duration-300 w-full group-hover:h-1.5 opacity-80"></div>
                <div class="p-6">
                    <div class="flex items-start justify-between">
                        <div>
                            <h3 class="text-app-textMuted text-xs font-semibold uppercase tracking-wider">Stock Crítico</h3>
                            <p class="text-3xl font-bold text-white mt-1 group-hover:text-red-400 transition-colors">{{ $stockBajo }}</p>
                        </div>
                        <div class="p-3 bg-red-500/10 rounded-xl text-red-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        </div>
                    </div>
                </div>
                <div class="bg-app-bg/50 px-6 py-3 border-t border-app-accent/50">
                    <span class="text-xs font-medium text-red-400 flex items-center gap-1">Requiere atención inmediata</span>
                </div>
            </div>

            <div class="bg-app-card rounded-2xl shadow-lg border border-app-accent/50 overflow-hidden group hover:border-blue-500/50 transition-colors duration-300 relative">
                <div class="absolute bottom-0 left-0 h-1 bg-gradient-to-r from-blue-400 to-indigo-600 transition-all duration-300 w-full group-hover:h-1.5 opacity-80"></div>
                <div class="p-6">
                    <div class="flex items-start justify-between">
                        <div>
                            <h3 class="text-app-textMuted text-xs font-semibold uppercase tracking-wider">Ventas del Mes</h3>
                            <p class="text-3xl font-bold text-white mt-1 group-hover:text-blue-400 transition-colors">${{ number_format($ventasMes, 2) }}</p>
                        </div>
                        <div class="p-3 bg-blue-500/10 rounded-xl text-blue-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                        </div>
                    </div>
                </div>
                <div class="bg-app-bg/50 px-6 py-3 border-t border-app-accent/50">
                    <span class="text-xs font-medium text-blue-400 flex items-center gap-1">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"></path></svg>
                         {{ $transaccionesMes }} transacciones acumuladas
                    </span>
                </div>
            </div>

        </div>

        {{-- Ventas recientes y Top productos --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

            <!-- Ventas Recientes -->
            <div class="bg-app-card rounded-2xl shadow-lg border border-app-accent/50 flex flex-col h-[400px]">
                <div class="flex justify-between items-center p-6 border-b border-app-accent/50">
                    <h3 class="text-lg font-bold text-white flex items-center gap-2">
                        <svg class="w-5 h-5 text-app-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Ventas Recientes
                    </h3>
                    <a href="{{ route('ventas.index') }}" class="text-app-textMuted hover:text-white text-sm font-semibold hover:underline bg-app-bg px-3 py-1 rounded-lg border border-app-accent transition-colors">Ver todas</a>
                </div>
                <div class="flex-1 overflow-y-auto p-2">
                    <ul class="space-y-2 p-4">
                        @forelse($ventasRecientes as $venta)
                            <li class="flex items-center justify-between p-4 bg-app-bg rounded-xl border border-app-accent/30 hover:border-app-primary/30 transition-colors">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-full bg-app-card flex items-center justify-center text-app-textMuted">
                                        🎟️
                                    </div>
                                    <div>
                                        <div class="font-semibold text-white text-sm">Venta #{{ substr($venta->id, 0, 8) }}</div>
                                        <div class="text-xs text-app-textMuted flex items-center gap-2">
                                            <span>{{ $venta->fecha_venta->format('d/m/Y H:i') }}</span>
                                            <span class="w-1 h-1 bg-app-accent rounded-full inline-block"></span>
                                            <span class="capitalize text-emerald-400 font-medium">{{ $venta->metodo_pago }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="font-bold text-app-primary">${{ number_format($venta->total, 2) }}</div>
                            </li>
                        @empty
                            <div class="flex flex-col items-center justify-center h-full text-app-textMuted space-y-3 opacity-50 pt-10">
                                <span class="text-4xl">🛒</span>
                                <p>Aún no hay ventas recientes</p>
                            </div>
                        @endforelse
                    </ul>
                </div>
            </div>

            <!-- Top Productos -->
            <div class="bg-app-card rounded-2xl shadow-lg border border-app-accent/50 flex flex-col h-[400px]">
                <div class="flex justify-between items-center p-6 border-b border-app-accent/50">
                    <h3 class="text-lg font-bold text-white flex items-center gap-2">
                        <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        Top 5 Más Vendidos
                    </h3>
                    <a href="{{ route('reportes.index') }}" class="text-app-textMuted hover:text-white text-sm font-semibold hover:underline bg-app-bg px-3 py-1 rounded-lg border border-app-accent transition-colors">Reportes</a>
                </div>
                <div class="flex-1 overflow-y-auto p-2">
                    <ul class="space-y-2 p-4">
                        @forelse($topProductos as $index => $producto)
                            <li class="flex items-center justify-between p-3 bg-app-bg rounded-xl border border-app-accent/30 hover:bg-app-card transition-colors">
                                <div class="flex items-center gap-4">
                                    <div class="w-8 h-8 rounded-lg bg-{{ $index == 0 ? 'amber-500/20' : ($index == 1 ? 'slate-400/20' : ($index == 2 ? 'amber-700/20' : 'app-primary/10')) }} text-{{ $index == 0 ? 'amber-500' : ($index == 1 ? 'slate-300' : ($index == 2 ? 'amber-600' : 'app-primary')) }} font-bold text-sm flex items-center justify-center border border-current/20 shadow-sm">
                                        #{{ $index + 1 }}
                                    </div>
                                    <div>
                                        <div class="font-semibold text-white text-sm leading-tight">{{ $producto->nombre }}</div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="font-bold text-app-textMain">{{ $producto->total_vendido }} <span class="text-xs text-app-textMuted font-normal">uds.</span></div>
                                </div>
                            </li>
                        @empty
                            <div class="flex flex-col items-center justify-center h-full text-app-textMuted space-y-3 opacity-50 pt-10">
                                <span class="text-4xl">📦</span>
                                <p>No hay datos de productos vendidos</p>
                            </div>
                        @endforelse
                    </ul>
                </div>
            </div>

        </div>

        {{-- Row Inferior --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 pb-8">

            <!-- Métodos de Pago -->
            <div class="bg-app-card rounded-2xl shadow-lg border border-app-accent/50 p-6 flex flex-col">
                <h3 class="text-lg font-bold text-white mb-6 border-b border-app-accent/50 pb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    Distribución de Pagos
                </h3>
                <div class="space-y-4 flex-1">
                    @forelse($metodosPago as $metodo)
                        <div class="bg-app-bg border border-app-accent/50 p-4 rounded-xl">
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center gap-2">
                                    <span class="text-xl">
                                        @if($metodo->metodo_pago == 'efectivo') 💵
                                        @elseif($metodo->metodo_pago == 'tarjeta') 💳
                                        @else 🏦 @endif
                                    </span>
                                    <span class="font-semibold text-white capitalize text-sm">{{ $metodo->metodo_pago }}</span>
                                </div>
                                <span class="text-app-textMuted text-xs">{{ number_format($metodo->porcentaje, 1) }}%</span>
                            </div>
                            <!-- Barra de progreso miniatura -->
                            <div class="w-full bg-app-card rounded-full h-1.5 mb-2 overflow-hidden">
                                <div class="bg-emerald-400 h-1.5 rounded-full" style="width: {{ $metodo->porcentaje }}%"></div>
                            </div>
                            <div class="text-right font-semibold text-emerald-400 text-sm">
                                ${{ number_format($metodo->total, 2) }}
                            </div>
                        </div>
                    @empty
                        <div class="text-center text-app-textMuted opacity-50 py-8">
                            <span class="text-4xl block mb-2">💳</span>
                            Sin datos disponibles
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Stock Crítico Alertas -->
            <div class="bg-app-card rounded-2xl shadow-lg border border-app-accent/50 p-6 flex flex-col">
                <h3 class="text-lg font-bold text-white mb-6 border-b border-app-accent/50 pb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    Alertas de Stock
                </h3>
                <div class="space-y-3 flex-1 overflow-y-auto pr-1">
                    @forelse($productosStockBajo as $producto)
                        <div class="flex items-center justify-between p-3 bg-red-500/10 rounded-xl border border-red-500/20 group">
                            <div class="truncate pr-4">
                                <div class="font-medium text-white text-sm truncate">{{ $producto->nombre }}</div>
                                <div class="text-xs text-app-textMuted mt-0.5">{{ $producto->categoria }}</div>
                            </div>
                            <div class="text-right flex-shrink-0">
                                <div class="font-bold text-red-400 bg-red-500/20 px-2 py-0.5 rounded-md inline-block">{{ $producto->stock }} <span class="text-[10px] font-normal">uds</span></div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center text-emerald-500/70 border border-emerald-500/20 bg-emerald-500/5 py-8 rounded-xl h-full flex flex-col items-center justify-center">
                            <span class="text-4xl block mb-2">✌️</span>
                            <span class="text-sm font-medium">Stock en estado óptimo</span>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Resumen Semanal Rápido -->
            <div class="bg-gradient-to-br from-app-card to-[#0b0f19] rounded-2xl shadow-lg border border-app-accent/50 p-6 flex flex-col relative overflow-hidden">
                <div class="absolute -right-6 -bottom-6 opacity-5 pointer-events-none">
                    <svg class="w-40 h-40 text-app-primary" fill="currentColor" viewBox="0 0 24 24"><path d="M7 19h2V5H7v14zm4 0h2V11h-2v8zm4 0h2v-6h-2v6zM4 21h17v-2H4v2z"></path></svg>
                </div>
                <h3 class="text-lg font-bold text-white mb-6 border-b border-app-accent/50 pb-4 z-10 flex items-center gap-2">
                    <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    Pulso Semanal
                </h3>
                <div class="flex-1 space-y-4 z-10 flex flex-col justify-center">
                    
                    <div class="bg-app-bg/50 backdrop-blur-sm border border-app-accent/30 p-4 rounded-xl flex items-center justify-between group hover:bg-app-bg transition-colors">
                        <div>
                            <div class="text-xs text-app-textMuted font-medium uppercase tracking-wide mb-1">Ingresos 7D</div>
                            <div class="text-2xl font-bold text-indigo-400">${{ number_format($totalSemana, 2) }}</div>
                        </div>
                        <div class="w-10 h-10 rounded-full bg-indigo-500/10 flex items-center justify-center text-indigo-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                    </div>
                    
                    <div class="bg-app-bg/50 backdrop-blur-sm border border-app-accent/30 p-4 rounded-xl flex items-center justify-between group hover:bg-app-bg transition-colors">
                        <div>
                            <div class="text-xs text-app-textMuted font-medium uppercase tracking-wide mb-1">Promedio Diario</div>
                            <div class="text-2xl font-bold text-app-primary">${{ number_format($promedioSemana, 2) }}</div>
                        </div>
                        <div class="w-10 h-10 rounded-full bg-app-primary/10 flex items-center justify-center text-app-primary">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                        </div>
                    </div>

                    <div class="bg-app-bg/50 backdrop-blur-sm border border-app-accent/30 p-4 rounded-xl flex items-center justify-between group hover:bg-app-bg transition-colors">
                        <div>
                            <div class="text-xs text-app-textMuted font-medium uppercase tracking-wide mb-1">Cajas Cerradas</div>
                            <div class="text-2xl font-bold text-white">{{ $transaccionesSemana }}</div>
                        </div>
                        <div class="w-10 h-10 rounded-full bg-slate-500/10 flex items-center justify-center text-slate-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>
@endsection