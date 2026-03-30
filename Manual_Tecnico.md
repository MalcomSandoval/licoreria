# Manual Técnico - Punto Frío Beto

El presente manual describe la arquitectura, stack tecnológico, estructura de directorios y componentes principales del sistema web "Punto Frío Beto", diseñado para la administración y control de inventario de una licorería.

## 1. Stack Tecnológico

El sistema ha sido desarrollado bajo un esquema monolítico utilizando las siguientes tecnologías:

### Backend
- **Framework:** Laravel (PHP)
- **Base de Datos:** MySQL / MariaDB (Relacional)
- **Autenticación:** Sistema integrado de Laravel (Presumiblemente Breeze/Sanctum o Auth de Laravel UI)
- **Routing:** Módulos de rutas en `routes/web.php`

### Frontend (Rediseño Premium Dark Mode)
- **Motor de Plantillas:** Laravel Blade
- **Estilos:** Tailwind CSS (vía CDN en el entorno actual para agilidad, usando JIT compilation en el navegador o un build estático). Se aplicó una paleta de colores personalizada extendida:
  - `app-bg`: Fondo principal oscuro (`#0f172a` - slate-900).
  - `app-card`: Fondo de tarjetas/paneles (`#1e293b` - slate-800).
  - `app-primary`: Color primario (Ámbar, `#f59e0b`).
  - `app-accent`: Bordes y separadores (`#334155` - slate-700).
- **Tipografía:** [Outfit](https://fonts.google.com/specimen/Outfit) (Google Fonts).
- **Interactividad (JS):** Alpine.js para manejo de estados en la UI (modales, dropdowns, sidebar) y Vanilla JavaScript (ES6) integrado en las vistas Blade (Directivas `@push('scripts')`) para llamadas asíncronas (`fetch API`) a los endpoints del servidor.
- **Iconografía:** SVGs incrustados genéricos de Heroicons.

## 2. Estructura de Proyecto

Las vistas del frontend se encuentran organizadas bajo `resources/views/`:

- `layouts/`:
  - `app.blade.php`: Plantilla principal del sistema (Contiene Sidebar, Navbar y dependencias globales).
  - `auth.blade.php`: Plantilla para pantallas de autenticación (Login, Registro).
- `auth/`:
  - `login.blade.php`, `registro.blade.php`, `verificar.blade.php`: Flujo de acceso de usuarios.
- `dashboard/`:
  - `index.blade.php`: Panel principal de métricas y resumen general.
- `productos/`:
  - `index.blade.php`: Gestión completa de inventario (CRUD mediante Modales JS, sin recarga).
- `ventas/`:
  - `index.blade.php`: Terminal de Punto de Venta (TPV / POS) e historial de facturas.
- `reportes/`:
  - `reportes.blade.php`: Analíticas financieras y de inventario exportables a PDF (usando `html2canvas` y `jsPDF`).

## 3. Arquitectura de Endpoints (API Interna)

El sistema utiliza llamadas AJAX (Fetch API) integradas desde las vistas para lograr una experiencia de tipo SPA (Single Page Application) en los módulos transaccionales.

- **Productos:**
  - `GET /productos/filtrar`: Retorna JSON de productos según estado, stock, búsqueda o categoría.
  - `POST /productos`: Crea un nuevo producto.
  - `PUT /productos/{id}`: Actualiza un producto.
  - `PATCH /productos/{id}/desactivar`: Archiva logicamente (Soft Delete).
  - `PATCH /productos/{id}/activar`: Reactiva logicamente.
- **Ventas:**
  - `POST /ventas`: Guarda en base de datos la cabecera e items (Substrae stock automáticamente).
  - `GET /ventas/filtrar`: Retorna historial según fechas o método de pago.
  - `GET /ventas/{id}/detalle`: Retorna los items (pivote) de una factura específica.
  - `DELETE /ventas/{id}`: Anulación de recibo.
- **Reportes:**
  - `GET /reportes/data`: Retorna data unificada procesada contablemente según un lapso (7 o 30 días).

## 4. Patrones de Diseño Frontend

El rediseño "Dark Mode" sigue pautas modernas:
- **Glassmorphism:** Uso sutil de transparencias en fondos (`bg-white/5`, `backdrop-blur`).
- **Estados Dinámicos:** Hover states brillantes (ej. `hover:border-emerald-500/50`) para dar feedback visual de las cards de estadísticas.
- **Modales Flotantes:** Centrados, con animación de entrada (`scale-95` a `scale-100`, fade in) bloqueando la interacción trasera (`pointer-events-none`).

## 5. Recomendaciones Tecnológicas a Futuro

1. **Migración Tailwind a Build System:** Actualmente las configuraciones de Tailwind personalizadas están en la etiqueta `<script>` dentro del layout. Para producción a escala, se debe compilar mediante Vite/NPM en un archivo CSS minificado.
2. **Modularización JS:** Extraer los pesados bloques de `<script>` que residen en los `.blade.php` hacia archivos `/public/js/*.js` para beneficiarse del *browser caching* y un código más limpio.
3. **Consistencia de BD:** Analizar el método `eliminarVenta`, dado que un borrado físico de la tabla `ventas` debería accionar un rollback del `stock` de los productos afectados mediante Eventos u Observers de Laravel.
