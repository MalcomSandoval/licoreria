@extends('layouts.app')

@section('title', 'Estadísticas de Inventario')

@section('content')
<div class="space-y-6 animate-fade-in" id="stats-wrapper">

    {{-- Encabezado --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h1 class="text-3xl font-bold text-white flex items-center gap-3">
                <span class="p-2 bg-app-primary/20 rounded-xl text-app-primary">📦</span>
                Estadísticas de Inventario
            </h1>
            <p class="text-app-textMuted mt-1 ml-14">Solo datos de inventario: stock, valorización, categorías y proveedores</p>
        </div>

        <button id="btn-refrescar" class="ml-14 md:ml-0 flex items-center gap-2 px-4 py-2.5 bg-app-card border border-app-accent rounded-xl text-sm text-white hover:border-app-primary/50 transition-colors shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
            Actualizar
        </button>
    </div>

    {{-- Loader global --}}
    <div id="global-loader" class="flex items-center justify-center py-20">
        <div class="animate-spin rounded-full h-10 w-10 border-t-2 border-b-2 border-app-primary"></div>
    </div>

    <div id="stats-content" class="hidden space-y-6">

        {{-- KPIs --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
            <div class="bg-gradient-to-br from-app-card to-app-bg border border-app-accent/50 rounded-2xl p-5 shadow-lg">
                <div class="flex items-center gap-3 mb-2">
                    <div class="bg-app-primary/10 p-2 rounded-lg text-app-primary">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    </div>
                    <h3 class="text-app-textMuted text-xs font-bold uppercase tracking-wider">Productos Activos</h3>
                </div>
                <h2 id="kpi-activos" class="text-2xl sm:text-3xl font-black text-white">0</h2>
                <p id="kpi-total-productos" class="text-[11px] text-app-textMuted mt-1"></p>
            </div>

            <div class="bg-gradient-to-br from-app-card to-app-bg border border-app-accent/50 rounded-2xl p-5 shadow-lg">
                <div class="flex items-center gap-3 mb-2">
                    <div class="bg-blue-500/10 p-2 rounded-lg text-blue-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    </div>
                    <h3 class="text-app-textMuted text-xs font-bold uppercase tracking-wider">Unidades en Stock</h3>
                </div>
                <h2 id="kpi-unidades" class="text-2xl sm:text-3xl font-black text-white">0</h2>
                <p class="text-[11px] text-app-textMuted mt-1">Total de unidades activas</p>
            </div>

            <div class="bg-gradient-to-br from-app-card to-app-bg border border-app-accent/50 rounded-2xl p-5 shadow-lg">
                <div class="flex items-center gap-3 mb-2">
                    <div class="bg-emerald-500/10 p-2 rounded-lg text-emerald-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-app-textMuted text-xs font-bold uppercase tracking-wider">Valor de Inventario</h3>
                </div>
                <h2 id="kpi-valor-venta" class="text-2xl sm:text-3xl font-black text-white">$0.00</h2>
                <p id="kpi-valor-compra" class="text-[11px] text-app-textMuted mt-1"></p>
            </div>

            <div class="bg-gradient-to-br from-app-card to-app-bg border border-app-accent/50 rounded-2xl p-5 shadow-lg">
                <div class="flex items-center gap-3 mb-2">
                    <div class="bg-red-500/10 p-2 rounded-lg text-red-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    </div>
                    <h3 class="text-app-textMuted text-xs font-bold uppercase tracking-wider">Stock Crítico / Agotado</h3>
                </div>
                <h2 id="kpi-stock-bajo" class="text-2xl sm:text-3xl font-black text-white">0</h2>
                <p id="kpi-sin-stock" class="text-[11px] text-app-textMuted mt-1"></p>
            </div>
        </div>

        {{-- Estado de stock + Activos vs Inactivos --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="bg-app-card rounded-2xl shadow-lg border border-app-accent/50 p-6">
                <h3 class="font-bold text-white text-lg mb-4">Estado del Stock</h3>
                <div class="h-64"><canvas id="chart-estado"></canvas></div>
            </div>

            <div class="bg-app-card rounded-2xl shadow-lg border border-app-accent/50 p-6">
                <h3 class="font-bold text-white text-lg mb-4">Productos Activos vs Inactivos</h3>
                <div class="h-64"><canvas id="chart-activos"></canvas></div>
            </div>

            <div class="bg-app-card rounded-2xl shadow-lg border border-app-accent/50 p-6">
                <h3 class="font-bold text-white text-lg mb-4">Resumen</h3>
                <div class="space-y-4 mt-6">
                    <div class="flex justify-between items-center border-b border-app-accent/30 pb-3">
                        <span class="text-app-textMuted text-sm">Categorías distintas</span>
                        <span id="kpi-categorias" class="text-white font-bold text-lg">0</span>
                    </div>
                    <div class="flex justify-between items-center border-b border-app-accent/30 pb-3">
                        <span class="text-app-textMuted text-sm">Proveedores con productos</span>
                        <span id="kpi-proveedores" class="text-white font-bold text-lg">0</span>
                    </div>
                    <div class="flex justify-between items-center border-b border-app-accent/30 pb-3">
                        <span class="text-app-textMuted text-sm">Productos inactivos</span>
                        <span id="kpi-inactivos" class="text-white font-bold text-lg">0</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-app-textMuted text-sm">Margen potencial estimado</span>
                        <span id="kpi-margen" class="text-emerald-400 font-bold text-lg">$0.00</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Por categoría --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="bg-app-card rounded-2xl shadow-lg border border-app-accent/50 p-6">
                <h3 class="font-bold text-white text-lg mb-4">Unidades en Stock por Categoría</h3>
                <div class="h-72"><canvas id="chart-categoria-unidades"></canvas></div>
            </div>

            <div class="bg-app-card rounded-2xl shadow-lg border border-app-accent/50 p-6">
                <h3 class="font-bold text-white text-lg mb-4">Valor de Inventario por Categoría</h3>
                <div class="h-72"><canvas id="chart-categoria-valor"></canvas></div>
            </div>
        </div>

        {{-- Por proveedor --}}
        <div class="bg-app-card rounded-2xl shadow-lg border border-app-accent/50 p-6">
            <h3 class="font-bold text-white text-lg mb-4">Unidades por Proveedor (Top 10)</h3>
            <div class="h-72"><canvas id="chart-proveedor"></canvas></div>
        </div>

        {{-- Top stock --}}
        <div class="bg-app-card rounded-2xl shadow-lg border border-app-accent/50 overflow-hidden">
            <div class="px-6 py-4 border-b border-app-accent/50 bg-app-bg">
                <h3 class="font-bold text-white text-lg">Top 10 Productos con Mayor Stock</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-app-card text-app-textMuted text-xs uppercase tracking-wider border-b border-app-accent/50">
                        <tr>
                            <th class="px-6 py-3 font-semibold w-16 text-center">#</th>
                            <th class="px-6 py-3 font-semibold">Producto</th>
                            <th class="px-6 py-3 font-semibold">Categoría</th>
                            <th class="px-6 py-3 font-semibold text-right">Stock</th>
                        </tr>
                    </thead>
                    <tbody id="tabla-top-stock" class="divide-y divide-app-accent/30 text-sm"></tbody>
                </table>
            </div>
        </div>

        {{-- Stock crítico --}}
        <div class="bg-app-card rounded-2xl shadow-lg border border-app-accent/50 overflow-hidden">
            <div class="px-6 py-4 border-b border-app-accent/50 bg-app-bg flex items-center gap-2">
                <span class="text-red-400">⚠️</span>
                <h3 class="font-bold text-white text-lg">Productos con Stock Crítico o Agotado</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-app-card text-app-textMuted text-xs uppercase tracking-wider border-b border-app-accent/50">
                        <tr>
                            <th class="px-6 py-3 font-semibold">Producto</th>
                            <th class="px-6 py-3 font-semibold">Categoría</th>
                            <th class="px-6 py-3 font-semibold">Proveedor</th>
                            <th class="px-6 py-3 font-semibold text-center">Stock</th>
                            <th class="px-6 py-3 font-semibold text-center">Stock Crítico</th>
                        </tr>
                    </thead>
                    <tbody id="tabla-stock-critico" class="divide-y divide-app-accent/30 text-sm"></tbody>
                </table>
            </div>
        </div>

        {{-- Mejor margen --}}
        <div class="bg-app-card rounded-2xl shadow-lg border border-app-accent/50 overflow-hidden">
            <div class="px-6 py-4 border-b border-app-accent/50 bg-app-bg">
                <h3 class="font-bold text-white text-lg">Top 10 Productos con Mejor Margen</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-app-card text-app-textMuted text-xs uppercase tracking-wider border-b border-app-accent/50">
                        <tr>
                            <th class="px-6 py-3 font-semibold w-16 text-center">#</th>
                            <th class="px-6 py-3 font-semibold">Producto</th>
                            <th class="px-6 py-3 font-semibold text-right">Precio Compra</th>
                            <th class="px-6 py-3 font-semibold text-right">Precio Venta</th>
                            <th class="px-6 py-3 font-semibold text-right">Margen</th>
                        </tr>
                    </thead>
                    <tbody id="tabla-margen" class="divide-y divide-app-accent/30 text-sm"></tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.umd.min.js"></script>
<script>
(function () {
    const COLOR_PRIMARY = '#f59e0b';
    const COLOR_MUTED = '#94a3b8';
    const COLOR_GRID = 'rgba(148, 163, 184, 0.1)';
    const PALETTE = ['#f59e0b', '#6366f1', '#10b981', '#3b82f6', '#ef4444', '#a855f7', '#ec4899', '#14b8a6', '#84cc16', '#f97316'];

    Chart.defaults.color = COLOR_MUTED;
    Chart.defaults.font.family = "'Outfit', sans-serif";

    let charts = {};

    function money(n) {
        return `$${Number(n).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
    }

    function destroyChart(key) {
        if (charts[key]) { charts[key].destroy(); }
    }

    async function cargar() {
        document.getElementById('global-loader').classList.remove('hidden');
        document.getElementById('stats-content').classList.add('hidden');
        try {
            const res = await fetch(`{{ route('estadisticas-inventario.data') }}`);
            const json = await res.json();
            render(json);
        } catch (e) {
            console.error('Error cargando estadísticas de inventario:', e);
        } finally {
            document.getElementById('global-loader').classList.add('hidden');
            document.getElementById('stats-content').classList.remove('hidden');
        }
    }

    function render(data) {
        // KPIs
        document.getElementById('kpi-activos').innerText = data.kpis.total_activos;
        document.getElementById('kpi-total-productos').innerText = `${data.kpis.total_productos} productos registrados en total`;
        document.getElementById('kpi-unidades').innerText = data.kpis.unidades_totales.toLocaleString('en-US');
        document.getElementById('kpi-valor-venta').innerText = money(data.kpis.valor_venta);
        document.getElementById('kpi-valor-compra').innerText = `Costo: ${money(data.kpis.valor_compra)}`;
        document.getElementById('kpi-stock-bajo').innerText = data.kpis.stock_bajo;
        document.getElementById('kpi-sin-stock').innerText = `${data.kpis.sin_stock} sin stock`;
        document.getElementById('kpi-categorias').innerText = data.kpis.total_categorias;
        document.getElementById('kpi-proveedores').innerText = data.kpis.total_proveedores;
        document.getElementById('kpi-inactivos').innerText = data.kpis.total_inactivos;
        document.getElementById('kpi-margen').innerText = money(data.kpis.valor_venta - data.kpis.valor_compra);

        // Estado de stock (doughnut)
        destroyChart('estado');
        charts.estado = new Chart(document.getElementById('chart-estado'), {
            type: 'doughnut',
            data: {
                labels: data.estado_stock.map(e => e.estado),
                datasets: [{
                    data: data.estado_stock.map(e => e.cantidad),
                    backgroundColor: ['#ef4444', '#f59e0b', '#10b981'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true, maintainAspectRatio: false,
                plugins: { legend: { position: 'bottom', labels: { boxWidth: 12, padding: 15 } } }
            }
        });

        // Activos vs inactivos (doughnut)
        destroyChart('activos');
        charts.activos = new Chart(document.getElementById('chart-activos'), {
            type: 'doughnut',
            data: {
                labels: data.activos_inactivos.map(e => e.estado),
                datasets: [{
                    data: data.activos_inactivos.map(e => e.cantidad),
                    backgroundColor: ['#6366f1', '#94a3b8'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true, maintainAspectRatio: false,
                plugins: { legend: { position: 'bottom', labels: { boxWidth: 12, padding: 15 } } }
            }
        });

        // Unidades por categoría
        destroyChart('categoriaUnidades');
        charts.categoriaUnidades = new Chart(document.getElementById('chart-categoria-unidades'), {
            type: 'bar',
            data: {
                labels: data.por_categoria.map(c => c.categoria),
                datasets: [{ label: 'Unidades', data: data.por_categoria.map(c => c.unidades), backgroundColor: COLOR_PRIMARY, borderRadius: 6 }]
            },
            options: {
                responsive: true, maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: { x: { grid: { display: false } }, y: { grid: { color: COLOR_GRID } } }
            }
        });

        // Valor por categoría
        destroyChart('categoriaValor');
        charts.categoriaValor = new Chart(document.getElementById('chart-categoria-valor'), {
            type: 'pie',
            data: {
                labels: data.por_categoria.map(c => c.categoria),
                datasets: [{ data: data.por_categoria.map(c => c.valor_venta), backgroundColor: PALETTE, borderWidth: 0 }]
            },
            options: {
                responsive: true, maintainAspectRatio: false,
                plugins: { legend: { position: 'bottom', labels: { boxWidth: 12, padding: 15 } } }
            }
        });

        // Por proveedor
        destroyChart('proveedor');
        charts.proveedor = new Chart(document.getElementById('chart-proveedor'), {
            type: 'bar',
            data: {
                labels: data.por_proveedor.map(p => p.proveedor),
                datasets: [{ label: 'Unidades', data: data.por_proveedor.map(p => p.unidades), backgroundColor: '#6366f1', borderRadius: 6 }]
            },
            options: {
                indexAxis: 'y',
                responsive: true, maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: { x: { grid: { color: COLOR_GRID } }, y: { grid: { display: false } } }
            }
        });

        // Tabla top stock
        const tbodyStock = document.getElementById('tabla-top-stock');
        tbodyStock.innerHTML = data.top_stock.length ? data.top_stock.map((p, i) => `
            <tr class="hover:bg-app-bg/50 transition-colors">
                <td class="px-6 py-3 text-center"><span class="w-6 h-6 rounded bg-app-bg border border-app-accent flex items-center justify-center text-xs text-app-textMuted font-mono mx-auto">${i + 1}</span></td>
                <td class="px-6 py-3 font-medium text-white">${p.nombre}</td>
                <td class="px-6 py-3 text-app-textMuted">${p.categoria}</td>
                <td class="px-6 py-3 text-right font-bold text-white">${p.stock}</td>
            </tr>`).join('') : `<tr><td colspan="4" class="px-6 py-10 text-center text-app-textMuted">Sin datos de inventario</td></tr>`;

        // Tabla stock crítico
        const tbodyCritico = document.getElementById('tabla-stock-critico');
        tbodyCritico.innerHTML = data.stock_critico.length ? data.stock_critico.map(p => `
            <tr class="hover:bg-app-bg/50 transition-colors">
                <td class="px-6 py-3 font-medium text-white">${p.nombre}</td>
                <td class="px-6 py-3 text-app-textMuted">${p.categoria}</td>
                <td class="px-6 py-3 text-app-textMuted">${p.proveedor}</td>
                <td class="px-6 py-3 text-center"><span class="px-2 py-0.5 rounded text-xs font-bold ${p.stock <= 0 ? 'bg-red-500/10 text-red-400 border border-red-500/20' : 'bg-amber-500/10 text-amber-400 border border-amber-500/20'}">${p.stock}</span></td>
                <td class="px-6 py-3 text-center text-app-textMuted">${p.stock_critico}</td>
            </tr>`).join('') : `<tr><td colspan="5" class="px-6 py-10 text-center text-app-textMuted">No hay productos en estado crítico 🎉</td></tr>`;

        // Tabla mejor margen
        const tbodyMargen = document.getElementById('tabla-margen');
        tbodyMargen.innerHTML = data.mejor_margen.length ? data.mejor_margen.map((p, i) => `
            <tr class="hover:bg-app-bg/50 transition-colors">
                <td class="px-6 py-3 text-center"><span class="w-6 h-6 rounded bg-app-bg border border-app-accent flex items-center justify-center text-xs text-app-textMuted font-mono mx-auto">${i + 1}</span></td>
                <td class="px-6 py-3 font-medium text-white">${p.nombre}</td>
                <td class="px-6 py-3 text-right text-app-textMuted">${money(p.precio_compra)}</td>
                <td class="px-6 py-3 text-right text-app-textMuted">${money(p.precio_venta)}</td>
                <td class="px-6 py-3 text-right font-bold text-emerald-400">${p.margen_pct}%</td>
            </tr>`).join('') : `<tr><td colspan="5" class="px-6 py-10 text-center text-app-textMuted">Sin datos suficientes</td></tr>`;
    }

    document.getElementById('btn-refrescar').addEventListener('click', cargar);
    document.addEventListener('DOMContentLoaded', cargar);
})();
</script>
@endpush
