@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="space-y-8">

        {{-- Encabezado --}}
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-[#1e3a8a]">Dashboard</h1>
                <p class="text-gray-600 mt-1">Resumen general del negocio</p>
            </div>
            <div class="text-right text-sm text-gray-500">
                <div>Última actualización:</div>
                <div id="ultima-actualizacion">{{ now()->format('H:i:s') }}</div>
            </div>
        </div>

        {{-- Métricas principales --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

            <div
                class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-[#1e3a8a] transform transition-all duration-200 hover:scale-105">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-gray-500 text-sm font-medium uppercase tracking-wide">Ventas Hoy</h3>
                        <p class="text-3xl font-bold text-gray-900 mt-2">${{ number_format($ventasHoy, 2) }}</p>
                        <div class="flex items-center mt-2">
                            <span class="text-sm font-medium text-green-600">{{ $cantidadHoy }} ventas</span>
                        </div>
                    </div>
                    <div class="text-4xl opacity-80">💰</div>
                </div>
            </div>

            <div
                class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-[#f59e0b] transform transition-all duration-200 hover:scale-105">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-gray-500 text-sm font-medium uppercase tracking-wide">Productos</h3>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalProductos }}</p>
                        <div class="flex items-center mt-2">
                            <span class="text-sm font-medium text-[#1e3a8a]">{{ $productosActivos }} activos</span>
                        </div>
                    </div>
                    <div class="text-4xl opacity-80">📦</div>
                </div>
            </div>

            <div
                class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-red-500 transform transition-all duration-200 hover:scale-105">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-gray-500 text-sm font-medium uppercase tracking-wide">Stock Bajo</h3>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stockBajo }}</p>
                        <div class="flex items-center mt-2">
                            <span class="text-sm font-medium text-red-600">Requiere atención</span>
                        </div>
                    </div>
                    <div class="text-4xl opacity-80">⚠️</div>
                </div>
            </div>

            <div
                class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-green-500 transform transition-all duration-200 hover:scale-105">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-gray-500 text-sm font-medium uppercase tracking-wide">Ventas del Mes</h3>
                        <p class="text-3xl font-bold text-gray-900 mt-2">${{ number_format($ventasMes, 2) }}</p>
                        <div class="flex items-center mt-2">
                            <span class="text-sm font-medium text-green-600">{{ $transaccionesMes }} transacciones</span>
                        </div>
                    </div>
                    <div class="text-4xl opacity-80">📈</div>
                </div>
            </div>

        </div>

        {{-- Ventas recientes y Top productos --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold text-[#1e3a8a]">Ventas Recientes</h3>
                    <a href="{{ route('ventas.index') }}"
                        class="text-[#1e3a8a] hover:text-[#1e2e6b] text-sm font-medium">Ver todas →</a>
                </div>
                <div class="space-y-4">
                    @forelse($ventasRecientes as $venta)
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                            <div>
                                <div class="font-medium text-gray-900">Venta #{{ substr($venta->id, 0, 8) }}</div>
                                <div class="text-sm text-gray-500">{{ $venta->fecha_venta->format('d/m/Y H:i') }}</div>
                                <div class="text-xs text-gray-400 capitalize">{{ $venta->metodo_pago }}</div>
                            </div>
                            <div class="font-bold text-[#1e3a8a]">${{ number_format($venta->total, 2) }}</div>
                        </div>
                    @empty
                        <div class="text-center text-gray-500 py-8">
                            <div class="text-4xl mb-4">🛒</div>
                            <p>No hay ventas recientes</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold text-[#1e3a8a]">Top Productos</h3>
                    <a href="{{ route('reportes.index') }}"
                        class="text-[#1e3a8a] hover:text-[#1e2e6b] text-sm font-medium">Ver reportes →</a>
                </div>
                <div class="space-y-4">
                    @forelse($topProductos as $index => $producto)
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                            <div class="flex items-center space-x-3">
                                <div
                                    class="w-8 h-8 bg-[#1e3a8a] text-white rounded-full flex items-center justify-center text-sm font-bold">
                                    {{ $index + 1 }}
                                </div>
                                <div>
                                    <div class="font-medium text-gray-900">{{ $producto->nombre }}</div>
                                    <div class="text-sm text-gray-600">{{ $producto->total_vendido }} vendidos</div>
                                </div>
                            </div>
                            <div class="font-bold text-[#f59e0b]">{{ $producto->total_vendido }}</div>
                        </div>
                    @empty
                        <div class="text-center text-gray-500 py-8">
                            <div class="text-4xl mb-4">📦</div>
                            <p>No hay datos de productos vendidos</p>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>

        {{-- Métodos de pago, Stock bajo, Resumen semanal --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-xl font-bold text-[#1e3a8a] mb-6">Métodos de Pago</h3>
                <div class="space-y-4">
                    @forelse($metodosPago as $metodo)
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <div class="flex items-center space-x-3">
                                <div class="text-xl">
                                    @if($metodo->metodo_pago == 'efectivo') 💵
                                    @elseif($metodo->metodo_pago == 'tarjeta') 💳
                                    @else 🏦 @endif
                                </div>
                                <div>
                                    <div class="font-medium capitalize">{{ $metodo->metodo_pago }}</div>
                                    <div class="text-sm text-gray-600">{{ number_format($metodo->porcentaje, 1) }}%</div>
                                </div>
                            </div>
                            <div class="font-bold text-[#1e3a8a]">${{ number_format($metodo->total, 2) }}</div>
                        </div>
                    @empty
                        <div class="text-center text-gray-500 py-8">
                            <div class="text-4xl mb-4">💳</div>
                            <p>No hay datos</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-xl font-bold text-[#1e3a8a] mb-6">Productos con Stock Bajo</h3>
                <div class="space-y-3">
                    @forelse($productosStockBajo as $producto)
                        <div class="flex items-center justify-between p-3 bg-red-50 rounded-lg border border-red-200">
                            <div>
                                <div class="font-medium text-gray-900">{{ $producto->nombre }}</div>
                                <div class="text-sm text-gray-600">{{ $producto->categoria }}</div>
                            </div>
                            <div class="text-right">
                                <div class="font-bold text-red-600">{{ $producto->stock }}</div>
                                <div class="text-xs text-red-500">Stock bajo</div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center text-gray-500 py-8">
                            <div class="text-4xl mb-4">✅</div>
                            <p class="text-sm">Todos los productos tienen stock suficiente</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-xl font-bold text-[#1e3a8a] mb-6">Resumen Semanal</h3>
                <div class="space-y-4">
                    <div class="p-4 bg-blue-50 rounded-lg">
                        <div class="text-2xl font-bold text-[#1e3a8a]">${{ number_format($totalSemana, 2) }}</div>
                        <div class="text-sm text-gray-600">Total últimos 7 días</div>
                    </div>
                    <div class="p-4 bg-yellow-50 rounded-lg">
                        <div class="text-2xl font-bold text-[#f59e0b]">${{ number_format($promedioSemana, 2) }}</div>
                        <div class="text-sm text-gray-600">Promedio diario</div>
                    </div>
                    <div class="p-4 bg-green-100 rounded-lg">
                        <div class="text-2xl font-bold text-green-600">{{ $transaccionesSemana }}</div>
                        <div class="text-sm text-gray-600">Transacciones</div>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection