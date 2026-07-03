@extends('layouts.app')

@section('title', 'Estadísticas de Ventas')

@section('content')
    <div class="space-y-6 animate-fade-in" id="stats-wrapper">

        {{-- Encabezado --}}
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h1 class="text-3xl font-bold text-white flex items-center gap-3">
                    <span class="p-2 bg-app-primary/20 rounded-xl text-app-primary">📊</span>
                    Estadísticas de Ventas
                </h1>
                <p class="text-app-textMuted mt-1 ml-14">Solo datos de ventas: ingresos, tendencias y comportamiento de
                    compra</p>
            </div>

            <div class="relative ml-14 md:ml-0">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-app-textMuted">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                </div>
                <select id="periodo"
                    class="pl-9 pr-8 py-2.5 bg-app-card border border-app-accent rounded-xl text-sm text-white focus:outline-none focus:border-app-primary appearance-none shadow-sm cursor-pointer transition-colors hover:border-app-primary/50">
                    <option value="7">Últimos 7 días</option>
                    <option value="30" selected>Últimos 30 días</option>
                    <option value="90">Últimos 90 días</option>
                    <option value="365">Último año</option>
                </select>
                <div class="absolute inset-y-0 right-0 pr-2 flex items-center pointer-events-none text-app-textMuted">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Loader global --}}
        <div id="global-loader" class="flex items-center justify-center py-20">
            <div class="animate-spin rounded-full h-10 w-10 border-t-2 border-b-2 border-app-primary"></div>
        </div>

        <div id="stats-content" class="hidden space-y-6">

            {{-- KPIs --}}
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
                <div
                    class="bg-gradient-to-br from-app-card to-app-bg border border-app-accent/50 rounded-2xl p-5 shadow-lg relative overflow-hidden">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="bg-app-primary/10 p-2 rounded-lg text-app-primary">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-app-textMuted text-xs font-bold uppercase tracking-wider">Ingresos</h3>
                    </div>
                    <h2 id="kpi-ingresos" class="text-2xl sm:text-3xl font-black text-white">$0.00</h2>
                    <p id="kpi-variacion" class="text-[11px] mt-1 font-semibold"></p>
                </div>

                <div
                    class="bg-gradient-to-br from-app-card to-app-bg border border-app-accent/50 rounded-2xl p-5 shadow-lg">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="bg-blue-500/10 p-2 rounded-lg text-blue-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-app-textMuted text-xs font-bold uppercase tracking-wider">Transacciones</h3>
                    </div>
                    <h2 id="kpi-transacciones" class="text-2xl sm:text-3xl font-black text-white">0</h2>
                    <p class="text-[11px] text-app-textMuted mt-1">Ventas registradas</p>
                </div>

                <div
                    class="bg-gradient-to-br from-app-card to-app-bg border border-app-accent/50 rounded-2xl p-5 shadow-lg">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="bg-amber-500/10 p-2 rounded-lg text-amber-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-app-textMuted text-xs font-bold uppercase tracking-wider">Ticket Promedio</h3>
                    </div>
                    <h2 id="kpi-ticket" class="text-2xl sm:text-3xl font-black text-white">$0.00</h2>
                    <p class="text-[11px] text-app-textMuted mt-1">Por venta</p>
                </div>

                <div
                    class="bg-gradient-to-br from-app-card to-app-bg border border-app-accent/50 rounded-2xl p-5 shadow-lg">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="bg-emerald-500/10 p-2 rounded-lg text-emerald-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                        <h3 class="text-app-textMuted text-xs font-bold uppercase tracking-wider">Unidades Vendidas</h3>
                    </div>
                    <h2 id="kpi-unidades" class="text-2xl sm:text-3xl font-black text-white">0</h2>
                    <p class="text-[11px] text-app-textMuted mt-1">Total en el periodo</p>
                </div>
            </div>

            {{-- Evolución de ventas --}}
            <div class="bg-app-card rounded-2xl shadow-lg border border-app-accent/50 p-6">
                <h3 class="font-bold text-white text-lg mb-4">Evolución de Ingresos</h3>
                <div class="h-72"><canvas id="chart-linea"></canvas></div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                {{-- Método de pago --}}
                <div class="bg-app-card rounded-2xl shadow-lg border border-app-accent/50 p-6">
                    <h3 class="font-bold text-white text-lg mb-4">Ventas por Método de Pago</h3>
                    <div class="h-64"><canvas id="chart-pago"></canvas></div>
                </div>

                {{-- Día de la semana --}}
                <div class="bg-app-card rounded-2xl shadow-lg border border-app-accent/50 p-6">
                    <h3 class="font-bold text-white text-lg mb-4">Ventas por Día de la Semana</h3>
                    <div class="h-64"><canvas id="chart-diasemana"></canvas></div>
                </div>

                {{-- Hora del día --}}
                <div class="bg-app-card rounded-2xl shadow-lg border border-app-accent/50 p-6">
                    <h3 class="font-bold text-white text-lg mb-4">Ventas por Hora del Día</h3>
                    <div class="h-64"><canvas id="chart-hora"></canvas></div>
                </div>

                {{-- Categorías --}}
                <div class="bg-app-card rounded-2xl shadow-lg border border-app-accent/50 p-6">
                    <h3 class="font-bold text-white text-lg mb-4">Ingresos por Categoría</h3>
                    <div class="h-64"><canvas id="chart-categoria"></canvas></div>
                </div>
            </div>

            {{-- Top productos --}}
            <div class="bg-app-card rounded-2xl shadow-lg border border-app-accent/50 overflow-hidden">
                <div class="px-6 py-4 border-b border-app-accent/50 bg-app-bg">
                    <h3 class="font-bold text-white text-lg">Top Productos Más Vendidos (unidades)</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead
                            class="bg-app-card text-app-textMuted text-xs uppercase tracking-wider border-b border-app-accent/50">
                            <tr>
                                <th class="px-6 py-3 font-semibold w-16 text-center">#</th>
                                <th class="px-6 py-3 font-semibold">Producto</th>
                                <th class="px-6 py-3 font-semibold text-center">Unidades</th>
                                <th class="px-6 py-3 font-semibold text-right">Ingresos</th>
                            </tr>
                        </thead>
                        <tbody id="tabla-top-productos" class="divide-y divide-app-accent/30 text-sm"></tbody>
                    </table>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                {{-- Vendedores --}}
                <div class="bg-app-card rounded-2xl shadow-lg border border-app-accent/50 overflow-hidden">
                    <div class="px-6 py-4 border-b border-app-accent/50 bg-app-bg">
                        <h3 class="font-bold text-white text-lg">Ventas por Vendedor</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead
                                class="bg-app-card text-app-textMuted text-xs uppercase tracking-wider border-b border-app-accent/50">
                                <tr>
                                    <th class="px-6 py-3 font-semibold">Usuario</th>
                                    <th class="px-6 py-3 font-semibold text-center">Transacciones</th>
                                    <th class="px-6 py-3 font-semibold text-right">Total</th>
                                </tr>
                            </thead>
                            <tbody id="tabla-vendedores" class="divide-y divide-app-accent/30 text-sm"></tbody>
                        </table>
                    </div>
                </div>

                {{-- Últimas ventas --}}
                <div class="bg-app-card rounded-2xl shadow-lg border border-app-accent/50 overflow-hidden">
                    <div class="px-6 py-4 border-b border-app-accent/50 bg-app-bg">
                        <h3 class="font-bold text-white text-lg">Últimas Ventas</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead
                                class="bg-app-card text-app-textMuted text-xs uppercase tracking-wider border-b border-app-accent/50">
                                <tr>
                                    <th class="px-6 py-3 font-semibold">Fecha</th>
                                    <th class="px-6 py-3 font-semibold text-center">Items</th>
                                    <th class="px-6 py-3 font-semibold text-center">Pago</th>
                                    <th class="px-6 py-3 font-semibold text-right">Total</th>
                                </tr>
                            </thead>
                            <tbody id="tabla-ultimas" class="divide-y divide-app-accent/30 text-sm"></tbody>
                        </table>
                    </div>
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
            const PALETTE = ['#f59e0b', '#6366f1', '#10b981', '#3b82f6', '#ef4444', '#a855f7', '#ec4899', '#14b8a6'];
            const DIAS = ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'];

            Chart.defaults.color = COLOR_MUTED;
            Chart.defaults.font.family = "'Outfit', sans-serif";

            let charts = {};
            let periodo = document.getElementById('periodo').value;

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
                    const res = await fetch(`{{ route('estadisticas.data') }}?periodo=${periodo}`);
                    const json = await res.json();
                    render(json);
                } catch (e) {
                    console.error('Error cargando estadísticas de ventas:', e);
                } finally {
                    document.getElementById('global-loader').classList.add('hidden');
                    document.getElementById('stats-content').classList.remove('hidden');
                }
            }

            function render(data) {
                // KPIs
                document.getElementById('kpi-ingresos').innerText = money(data.kpis.total_ingresos);
                document.getElementById('kpi-transacciones').innerText = data.kpis.total_transacciones;
                document.getElementById('kpi-ticket').innerText = money(data.kpis.ticket_promedio);
                document.getElementById('kpi-unidades').innerText = data.kpis.total_unidades;

                const variacionEl = document.getElementById('kpi-variacion');
                if (data.kpis.variacion_ingresos === null) {
                    variacionEl.innerText = 'Sin datos del periodo anterior';
                    variacionEl.className = 'text-[11px] mt-1 font-semibold text-app-textMuted';
                } else {
                    const v = data.kpis.variacion_ingresos;
                    variacionEl.innerText = `${v >= 0 ? '↑' : '↓'} ${Math.abs(v).toFixed(1)}% vs periodo anterior`;
                    variacionEl.className = `text-[11px] mt-1 font-semibold ${v >= 0 ? 'text-emerald-400' : 'text-red-400'}`;
                }

                // Línea: evolución diaria
                destroyChart('linea');
                const ctxLinea = document.getElementById('chart-linea').getContext('2d');
                const gradient = ctxLinea.createLinearGradient(0, 0, 0, 280);
                gradient.addColorStop(0, 'rgba(245, 158, 11, 0.35)');
                gradient.addColorStop(1, 'rgba(245, 158, 11, 0)');
                charts.linea = new Chart(ctxLinea, {
                    type: 'line',
                    data: {
                        labels: data.serie_diaria.map(d => new Date(d.fecha + 'T00:00:00').toLocaleDateString('es-CO', { day: '2-digit', month: 'short' })),
                        datasets: [{
                            label: 'Ingresos',
                            data: data.serie_diaria.map(d => parseFloat(d.total)),
                            borderColor: COLOR_PRIMARY,
                            backgroundColor: gradient,
                            fill: true,
                            tension: 0.35,
                            pointRadius: 2,
                            pointBackgroundColor: COLOR_PRIMARY,
                        }]
                    },
                    options: {
                        responsive: true, maintainAspectRatio: false,
                        plugins: { legend: { display: false } },
                        scales: {
                            x: { grid: { display: false } },
                            y: { grid: { color: COLOR_GRID }, ticks: { callback: v => '$' + v } }
                        }
                    }
                });

                // Método de pago
                destroyChart('pago');
                charts.pago = new Chart(document.getElementById('chart-pago'), {
                    type: 'doughnut',
                    data: {
                        labels: data.metodos_pago.map(m => (m.metodo_pago || 'N/A').charAt(0).toUpperCase() + (m.metodo_pago || 'n/a').slice(1)),
                        datasets: [{ data: data.metodos_pago.map(m => parseFloat(m.total)), backgroundColor: PALETTE, borderWidth: 0 }]
                    },
                    options: {
                        responsive: true, maintainAspectRatio: false,
                        plugins: { legend: { position: 'bottom', labels: { boxWidth: 12, padding: 15 } } }
                    }
                });

                // Día de la semana
                const mapaDias = {};
                data.dia_semana.forEach(d => { mapaDias[d.dia] = parseFloat(d.total); });
                destroyChart('diasemana');
                charts.diasemana = new Chart(document.getElementById('chart-diasemana'), {
                    type: 'bar',
                    data: {
                        labels: DIAS,
                        datasets: [{ data: [1, 2, 3, 4, 5, 6, 7].map(i => mapaDias[i] || 0), backgroundColor: COLOR_PRIMARY, borderRadius: 6 }]
                    },
                    options: {
                        responsive: true, maintainAspectRatio: false,
                        plugins: { legend: { display: false } },
                        scales: { x: { grid: { display: false } }, y: { grid: { color: COLOR_GRID } } }
                    }
                });

                // Hora del día
                const mapaHoras = {};
                data.hora_dia.forEach(h => { mapaHoras[h.hora] = parseFloat(h.total); });
                const horasLabels = Array.from({ length: 24 }, (_, i) => i);
                destroyChart('hora');
                charts.hora = new Chart(document.getElementById('chart-hora'), {
                    type: 'bar',
                    data: {
                        labels: horasLabels.map(h => `${h}h`),
                        datasets: [{ data: horasLabels.map(h => mapaHoras[h] || 0), backgroundColor: '#6366f1', borderRadius: 4 }]
                    },
                    options: {
                        responsive: true, maintainAspectRatio: false,
                        plugins: { legend: { display: false } },
                        scales: { x: { grid: { display: false }, ticks: { maxRotation: 0, autoSkip: true, maxTicksLimit: 12 } }, y: { grid: { color: COLOR_GRID } } }
                    }
                });

                // Categorías
                destroyChart('categoria');
                charts.categoria = new Chart(document.getElementById('chart-categoria'), {
                    type: 'pie',
                    data: {
                        labels: data.categorias.map(c => c.categoria),
                        datasets: [{ data: data.categorias.map(c => parseFloat(c.ingresos)), backgroundColor: PALETTE, borderWidth: 0 }]
                    },
                    options: {
                        responsive: true, maintainAspectRatio: false,
                        plugins: { legend: { position: 'bottom', labels: { boxWidth: 12, padding: 15 } } }
                    }
                });

                // Tabla top productos
                const tbodyProd = document.getElementById('tabla-top-productos');
                tbodyProd.innerHTML = data.top_productos.length ? data.top_productos.map((p, i) => `
                    <tr class="hover:bg-app-bg/50 transition-colors">
                        <td class="px-6 py-3 text-center"><span class="w-6 h-6 rounded bg-app-bg border border-app-accent flex items-center justify-center text-xs text-app-textMuted font-mono mx-auto">${i + 1}</span></td>
                        <td class="px-6 py-3 font-medium text-white">${p.nombre}</td>
                        <td class="px-6 py-3 text-center"><span class="bg-app-primary/10 text-app-primary border border-app-primary/20 px-2 py-0.5 rounded text-xs font-bold">${p.unidades}</span></td>
                        <td class="px-6 py-3 text-right font-bold text-white">${money(p.ingresos)}</td>
                    </tr>`).join('') : `<tr><td colspan="4" class="px-6 py-10 text-center text-app-textMuted">Sin datos para este periodo</td></tr>`;

                // Tabla vendedores
                const tbodyVend = document.getElementById('tabla-vendedores');
                tbodyVend.innerHTML = data.vendedores.length ? data.vendedores.map(v => `
                    <tr class="hover:bg-app-bg/50 transition-colors">
                        <td class="px-6 py-3 font-medium text-white">${v.nombre}</td>
                        <td class="px-6 py-3 text-center text-app-textMuted">${v.transacciones}</td>
                        <td class="px-6 py-3 text-right font-bold text-white">${money(v.total)}</td>
                    </tr>`).join('') : `<tr><td colspan="3" class="px-6 py-10 text-center text-app-textMuted">Sin datos para este periodo</td></tr>`;

                // Tabla últimas ventas
                const tbodyUlt = document.getElementById('tabla-ultimas');
                tbodyUlt.innerHTML = data.ultimas_ventas.length ? data.ultimas_ventas.map(v => `
                    <tr class="hover:bg-app-bg/50 transition-colors">
                        <td class="px-6 py-3 text-app-textMuted text-xs">${new Date(v.fecha_venta).toLocaleString('es-CO', { day: '2-digit', month: 'short', hour: '2-digit', minute: '2-digit' })}</td>
                        <td class="px-6 py-3 text-center text-app-textMuted">${v.items}</td>
                        <td class="px-6 py-3 text-center"><span class="text-[10px] uppercase px-2 py-0.5 rounded bg-app-accent/40 text-app-textMuted">${v.metodo_pago || '-'}</span></td>
                        <td class="px-6 py-3 text-right font-bold text-white">${money(v.total)}</td>
                    </tr>`).join('') : `<tr><td colspan="4" class="px-6 py-10 text-center text-app-textMuted">Sin ventas recientes</td></tr>`;
            }

            document.getElementById('periodo').addEventListener('change', e => {
                periodo = e.target.value;
                cargar();
            });

            document.addEventListener('DOMContentLoaded', cargar);
        })();
    </script>
@endpush