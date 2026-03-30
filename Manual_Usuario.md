# Manual de Usuario - Punto Frío Beto

Bienvenido al sistema de administración "Punto Frío Beto". Este manual te guiará para que puedas operar de forma fluida el punto de venta, inventarios y analíticas del sistema, el cual ahora cuenta con una estética "Dark Mode" premium diseñada para descansar la vista en periodos prolongados y enfatizar los datos importantes.

## 1. Acceso al Sistema

1. **Iniciar Sesión:** Ingresa tu correo y contraseña asignada por el superadministrador en la pantalla principal.
2. **Registro Remoto (si aplica):** Si eres un nuevo empleado y usas el link de registro, deberás completar tus datos. Posteriormente pasarás a una verificación de código (de 6 dígitos) enviada a tu correo para confirmar la autenticidad, luego de esto, el administrador debe habilitarte.
3. Si olvidas tu clave, contactar al superior (Por seguridad no hay links externos configurados de reseteo).

## 2. Panel Principal (Dashboard)

Una vez ingreses, verás el **Dashboard**. Aquí se resume la salud de tu tienda en un vistazo rápido:
- **Tarjetas Superiores:** Te muestran el Ventas Totales, Productos Activos en el sistema y Cantidad de Productos con Stock Crítico (por debajo de 5 unidades). Al pasar el mouse por las tarjetas, el borde se iluminará del color de la tarjeta.
- **Tablas:** Visualizarás listas rápidas de "Ventas Recientes" y "Productos Más Vendidos".
- **Navegación:** Al lado izquierdo se encuentra el menú principal (Sidebar). 

## 3. Gestión de Inventario (Módulo Productos)

La pestaña **Inventario** permite controlar las bodegas del local.

- **Filtrar:** Usa la barra de búsqueda central para buscar rápido por nombre. Abajo de la barra hay filtros por Categoría (Cervezas, Licores, Snacks) y por nivel de Stock.
- **Crear un Producto:**
  1. Haz clic en el botón ambar superior que dice **+ Nuevo Producto**.
  2. Aparecerá una ventana sobrepuesta. Llenar los campos requeridos (*Nombre*, *Precio Venta*, *Stock*). 
  3. Puedes añadir una "Categoría" y un código de barras para futuras integraciones. Clic en guardar.
- **Editar / Sumar Stock:**
  - En la lista de productos, pulsa el botón **Editar** de un producto.
  - Para evitar errores manuales, **el stock actual está bloqueado**. Para añadir nueva mercancía (ejemplo, llegó un camión), usa el campo verde *"Sumar Stock (+)"* para digitar la cantidad que llegó. El sistema hará la matemática automáticamente.
- **Desactivar:** Si no venderás más un producto, usa el botón rojo "Desactivar" para ocultarlo sin borrar sus datos pasados de la base de datos de auditoría.

## 4. Punto de Venta (Módulo Ventas)

La pestaña **Ventas** es el corazón operativo del negocio.

### 4.1. Hacer una venta
1. Haz clic en el gran botón verde **+ Nueva Venta** arriba a la derecha. Se desplegará la "Terminal de Venta".
2. **Buscar Producto:** Escribe el nombre. Se listarán opciones con su stock actual. Haz clic en el producto deseado.
3. **Cantidad:** Selecciona cuántas unidades llevará el cliente (si excedes el stock, el sistema lanzará un aviso rojo abajo y no te dejará continuar).
4. **Agregar:** Pulsa el botón transparente *"Añadir ↓"*. El producto bajará al área del carrito.
5. **Pagar:** Cuando el cliente decida finalizar, verifica el Total. Selecciona el **Método de Pago** (Efectivo, Tarjeta/Datáfono, Transferencia/Nequi) y pulsa **Procesar Cobro**.
6. Un aviso verde te confirmará el éxito y la página se refrescará solita.

### 4.2. Historial de Ventas
Abajo de la Terminal verás todas las facturas recientes.
- **Ver:** Permite abrir un Recibo para comprobar qué llevó en esa factura específica. Desde ahí podrás pulsar *Imprimir Copia*.
- **Anular / Borrar:** Cancela un ticket. (Nota de operaciones: Consulta a tu gerente si esta acción devuelve los productos al inventario).

## 5. Reportes y Analíticas

El módulo **Reportes** consolida tus finanzas.

- Selecciona arriba si deseas ver los datos de los **Últimos 7 días** o **Últimos 30 días**. Verás como los números cambian de forma interactiva.
- Analiza la "Utilidad (30%)", el "Ticket Promedio" y qué productos te están inyectando más capital.
- **Exportar Reporte:** Genera automáticamente un documento PDF (foto estática exacta de lo que ves en pantalla en fondo oscuro) ideal para enviar por WhatsApp al jefe al cierre de día.
