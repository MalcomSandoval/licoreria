@extends('layouts.app')

@section('title', 'Reportes')

@section('content')
    <div id="reporte-contenido" class="max-w-7xl mx-auto space-y-6">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-3xl font-bold text-[#1e3a8a]">Reportes</h1>
                <p class="text-gray-600 mt-1">Resumen de ventas y productos por periodo.</p>
            </div>

            <div class="flex gap-3">
                <select id="periodo" class="border border-gray-300 rounded-lg px-3 py-2 bg-white">
                    <option value="7">7 dias</option>
                    <option value="30">30 dias</option>
                </select>

                <button onclick="exportarPDF()" class="bg-[#1e3a8a] hover:bg-[#1e2e6b] text-white px-4 py-2 rounded-lg">
                    Exportar PDF
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">
            <div class="bg-white p-4 shadow rounded-xl">
                <p class="text-gray-500">Total Ventas</p>
                <h2 id="ventas" class="text-2xl font-bold text-[#1e3a8a]">$0</h2>
            </div>

            <div class="bg-white p-4 shadow rounded-xl">
                <p class="text-gray-500">Ganancia</p>
                <h2 id="ganancia" class="text-2xl font-bold text-[#1e3a8a]">$0</h2>
            </div>

            <div class="bg-white p-4 shadow rounded-xl">
                <p class="text-gray-500">Promedio</p>
                <h2 id="promedio" class="text-2xl font-bold text-[#1e3a8a]">$0</h2>
            </div>

            <div class="bg-white p-4 shadow rounded-xl">
                <p class="text-gray-500">Productos</p>
                <h2 id="productos" class="text-2xl font-bold text-[#1e3a8a]">0</h2>
            </div>
        </div>

        <div class="bg-white shadow rounded-xl p-4 overflow-x-auto">
            <table class="w-full min-w-[500px]">
                <thead>
                    <tr class="bg-gray-100 text-left">
                        <th class="p-3">Producto</th>
                        <th class="p-3">Cantidad</th>
                        <th class="p-3">Ingresos</th>
                    </tr>
                </thead>
                <tbody id="tabla"></tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script>
        const datos = {
            ventas: [],
            productos: [],
            periodo: 7
        };

        async function cargar() {
            const res = await fetch(`{{ route('reportes.data') }}?periodo=${datos.periodo}`);
            const json = await res.json();

            datos.ventas = json.ventas;
            datos.productos = json.productos;

            procesar();
        }

        function procesar() {
            let totalVentas = 0;
            let totalProductos = 0;
            const mapa = {};

            datos.ventas.forEach(venta => {
                totalVentas += parseFloat(venta.total);

                venta.detalles.forEach(detalle => {
                    totalProductos += detalle.cantidad;

                    const nombre = detalle.producto?.nombre || 'N/A';

                    if (!mapa[nombre]) {
                        mapa[nombre] = {
                            cantidad: 0,
                            ingresos: 0
                        };
                    }

                    mapa[nombre].cantidad += detalle.cantidad;
                    mapa[nombre].ingresos += parseFloat(detalle.subtotal);
                });
            });

            const promedio = datos.ventas.length ? totalVentas / datos.ventas.length : 0;
            const ganancia = totalVentas * 0.3;

            document.getElementById('ventas').innerText = `$${totalVentas.toFixed(2)}`;
            document.getElementById('ganancia').innerText = `$${ganancia.toFixed(2)}`;
            document.getElementById('promedio').innerText = `$${promedio.toFixed(2)}`;
            document.getElementById('productos').innerText = totalProductos;

            const tabla = Object.entries(mapa)
                .sort((a, b) => b[1].ingresos - a[1].ingresos);

            document.getElementById('tabla').innerHTML = tabla.map(([nombre, detalle]) => `
                <tr class="border-b">
                    <td class="p-3">${nombre}</td>
                    <td class="p-3">${detalle.cantidad}</td>
                    <td class="p-3">$${detalle.ingresos.toFixed(2)}</td>
                </tr>
            `).join('');
        }

        async function exportarPDF() {
            const { jsPDF } = window.jspdf;
            const canvas = await html2canvas(document.getElementById('reporte-contenido'));
            const img = canvas.toDataURL('image/png');

            const pdf = new jsPDF();
            pdf.addImage(img, 'PNG', 0, 0, 210, 295);
            pdf.save('reporte.pdf');
        }

        document.getElementById('periodo').addEventListener('change', event => {
            datos.periodo = event.target.value;
            cargar();
        });

        cargar();
    </script>
@endpush
