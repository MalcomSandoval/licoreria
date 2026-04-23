@extends('layouts.app')

@section('title', 'Directorio de Proveedores')

@section('content')
<div class="space-y-8 animate-fade-in" x-data="{ 
    modalOpen: false, 
    modoOperacion: 'crear',
    proveedorEditar: null,
    
    abrirModal(modo, proveedor = null) {
        this.modoOperacion = modo;
        this.proveedorEditar = proveedor;
        this.modalOpen = true;
        
        if (modo === 'crear') {
            document.getElementById('form-proveedor').reset();
            document.getElementById('form-proveedor').action = '{{ route('proveedores.store') }}';
            document.getElementById('method-proveedor').value = 'POST';
        } else {
            document.getElementById('form-proveedor').action = `/proveedores/${proveedor.id}`;
            document.getElementById('method-proveedor').value = 'PUT';
            document.getElementById('nombre').value = proveedor.nombre;
            document.getElementById('empresa').value = proveedor.empresa || '';
            document.getElementById('telefono').value = proveedor.telefono || '';
            document.getElementById('email').value = proveedor.email || '';
            document.getElementById('direccion').value = proveedor.direccion || '';
            document.getElementById('frecuencia_visita').value = proveedor.frecuencia_visita || '';
        }
    }
}">

    {{-- Encabezado --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h1 class="text-3xl font-bold text-white flex items-center gap-3">
                <span class="p-2 bg-indigo-500/20 rounded-xl text-indigo-400">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                </span>
                Gestión de Proveedores
            </h1>
            <p class="text-app-textMuted mt-1 ml-14">Administra el contacto con los surtidores de tu negocio</p>
        </div>
        <div class="ml-14 md:ml-0">
            <button @click="abrirModal('crear')"
                class="bg-indigo-500 hover:bg-indigo-400 text-white px-6 py-2.5 rounded-xl font-bold transition-all hover:scale-105 shadow-lg shadow-indigo-500/20 flex items-center justify-center gap-2">
                <span class="text-xl leading-none">+</span> Nuevo Proveedor
            </button>
        </div>
    </div>

    {{-- Grid de Proveedores --}}
    @if($proveedores->isEmpty())
        <div class="bg-app-card rounded-2xl border border-app-accent/50 p-12 text-center text-app-textMuted">
            <div class="text-5xl mb-4 opacity-50 flex justify-center">
                <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
            <p class="text-xl font-semibold mb-2 text-white">No hay proveedores registrados</p>
            <p class="text-sm">Agrega el primer proveedor haciendo clic en el botón superior.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($proveedores as $p)
                <div class="bg-app-card rounded-2xl border border-app-accent/50 p-6 flex flex-col hover:border-indigo-500/30 transition-colors group relative overflow-hidden shadow-sm hover:shadow-lg">
                    <!-- Banda lateral decorativa -->
                    <div class="absolute left-0 top-0 bottom-0 w-1 bg-gradient-to-b from-indigo-500 to-transparent opacity-50"></div>
                    
                    <div class="flex justify-between items-start mb-4">
                        <div class="w-12 h-12 rounded-xl bg-app-bg border border-app-accent flex items-center justify-center text-2xl">
                            🏢
                        </div>
                        <div class="flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                            <button @click="abrirModal('editar', {{ $p->toJson() }})" class="p-1.5 text-app-textMuted hover:text-white bg-app-bg rounded-lg border border-app-accent hover:bg-indigo-500/20 hover:border-indigo-500/50 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            </button>
                            <form action="{{ route('proveedores.destroy', $p->id) }}" method="POST" class="inline" onsubmit="return confirm('¿Estás seguro de eliminar este proveedor?');">
                                @csrf @method('DELETE')
                                <button class="p-1.5 text-app-textMuted hover:text-red-400 bg-app-bg rounded-lg border border-app-accent hover:bg-red-500/20 hover:border-red-500/50 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                    
                    <h3 class="text-xl font-bold text-white truncate">{{ $p->nombre }}</h3>
                    @if($p->empresa)
                        <p class="text-sm text-indigo-400 font-medium mb-3 truncate">{{ $p->empresa }}</p>
                    @else
                        <div class="mb-3"></div>
                    @endif
                    
                    <div class="space-y-2 text-sm text-app-textMuted mt-auto">
                        @if($p->telefono)
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                <span>{{ $p->telefono }}</span>
                            </div>
                        @endif
                        @if($p->email)
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                <span class="truncate">{{ $p->email }}</span>
                            </div>
                        @endif
                        @if($p->frecuencia_visita)
                            <div class="flex items-center gap-2 mt-4 pt-3 border-t border-app-accent/30">
                                <span class="bg-indigo-500/10 text-indigo-400 text-xs px-2 py-1 rounded border border-indigo-500/20 font-medium">
                                    Visita: {{ $p->frecuencia_visita }}
                                </span>
                            </div>
                        @endif
                        @php
                            $productosCriticos = $p->productos->filter(function($prod) {
                                return $prod->stock <= $prod->stock_critico;
                            });
                        @endphp
                        @if($productosCriticos->count() > 0)
                            <div class="mt-4 pt-4 border-t border-red-500/20">
                                <h4 class="text-xs font-bold text-red-400 uppercase tracking-wider mb-2 flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                    Reporte Crítico ({{ $productosCriticos->count() }})
                                </h4>
                                <ul class="space-y-1.5">
                                    @foreach($productosCriticos->take(3) as $pd)
                                        <li class="flex justify-between items-center text-xs bg-red-500/10 border border-red-500/20 px-2.5 py-1.5 rounded-lg">
                                            <span class="text-white truncate pr-2" title="{{ $pd->nombre }}">{{ $pd->nombre }}</span>
                                            <span class="text-red-400 font-bold whitespace-nowrap bg-red-500/20 px-1.5 py-0.5 rounded">{{ $pd->stock }} un</span>
                                        </li>
                                    @endforeach
                                    @if($productosCriticos->count() > 3)
                                        <li class="text-xs text-red-400 text-center block pt-1 font-medium">
                                            +{{ $productosCriticos->count() - 3 }} productos más...
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        @else
                            @if($p->productos->count() > 0)
                            <div class="mt-4 pt-4 border-t border-green-500/20">
                                <span class="bg-green-500/10 text-green-400 text-xs px-2.5 py-1.5 rounded-lg border border-green-500/20 font-medium flex items-center justify-center gap-1.5 w-full">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    Stock óptimo ({{ $p->productos->count() }} prod)
                                </span>
                            </div>
                            @endif
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    {{-- Modal Formulario --}}
    <div x-show="modalOpen" x-transition.opacity class="fixed inset-0 z-50 bg-app-bg/80 backdrop-blur-sm flex items-center justify-center p-4" style="display: none;">
        <div @click.away="modalOpen = false" class="bg-app-card rounded-2xl shadow-[0_0_40px_rgba(0,0,0,0.5)] border border-app-accent w-full max-w-xl flex flex-col transform transition-all duration-300">
            <form id="form-proveedor" method="POST">
                @csrf
                <input type="hidden" name="_method" id="method-proveedor" value="POST">
                
                <div class="p-6 border-b border-app-accent/50 flex justify-between items-center bg-app-bg rounded-t-2xl">
                    <h3 class="text-xl font-bold text-white flex items-center gap-2">
                        <span x-text="modoOperacion === 'crear' ? 'Nuevo Proveedor' : 'Editar Proveedor'"></span>
                    </h3>
                    <button type="button" @click="modalOpen = false" class="text-app-textMuted hover:text-white transition-colors p-1.5 rounded-lg border border-app-accent hover:bg-app-accent">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
                
                <div class="p-6 space-y-5">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-app-textMuted mb-1">Nombre (Contacto) <span class="text-red-500">*</span></label>
                            <input type="text" name="nombre" id="nombre" required
                                class="w-full px-4 py-3 bg-app-bg border border-app-accent rounded-xl text-white focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition">
                        </div>
                        
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-app-textMuted mb-1">Empresa Principal</label>
                            <input type="text" name="empresa" id="empresa" placeholder="Bavaria, Postobón, etc."
                                class="w-full px-4 py-3 bg-app-bg border border-app-accent rounded-xl text-white focus:outline-none focus:border-indigo-500 transition">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-app-textMuted mb-1">Teléfono</label>
                            <input type="text" name="telefono" id="telefono"
                                class="w-full px-4 py-3 bg-app-bg border border-app-accent rounded-xl text-white focus:outline-none focus:border-indigo-500 transition">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-app-textMuted mb-1">Correo Electrónico</label>
                            <input type="email" name="email" id="email"
                                class="w-full px-4 py-3 bg-app-bg border border-app-accent rounded-xl text-white focus:outline-none focus:border-indigo-500 transition">
                        </div>
                        
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-app-textMuted mb-1">Frecuencia de Visita</label>
                            <input type="text" name="frecuencia_visita" id="frecuencia_visita" placeholder="Ej: Todos los Martes y Jueves"
                                class="w-full px-4 py-3 bg-app-bg border border-app-accent rounded-xl text-white focus:outline-none focus:border-indigo-500 transition">
                        </div>
                        
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-app-textMuted mb-1">Dirección / Notas</label>
                            <textarea name="direccion" id="direccion" rows="2"
                                class="w-full px-4 py-3 bg-app-bg border border-app-accent rounded-xl text-white focus:outline-none focus:border-indigo-500 transition resize-none"></textarea>
                        </div>
                    </div>
                </div>
                
                <div class="p-5 border-t border-app-accent/50 bg-app-bg/50 rounded-b-2xl flex justify-end gap-3">
                    <button type="button" @click="modalOpen = false" class="px-5 py-2.5 bg-app-bg text-app-textMuted border border-app-accent hover:text-white rounded-xl transition-colors">
                        Cancelar
                    </button>
                    <button type="submit" class="px-6 py-2.5 bg-indigo-500 hover:bg-indigo-400 text-white font-bold rounded-xl transition-colors shadow-[0_0_15px_rgba(99,102,241,0.3)] hover:shadow-[0_0_20px_rgba(99,102,241,0.5)]">
                        Guardar Proveedor
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
