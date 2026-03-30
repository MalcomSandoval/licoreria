# Manual de Testeo (QA/Testing) - Punto Frío Beto

Este documento detalla los flujos de prueba (Testing Flows) que debe ejecutar el equipo de Quality Assurance (QA) o el administrador para verificar que el sistema "Punto Frío Beto" con el nuevo rediseño *Premium Dark Mode* funciona correctamente, no rompe la lógica base interconectada y brinda la experiencia visual deseada.

## 1. Pruebas de Interfaz (UI/UX) - Visual Testing

**Objetivo:** Verificar que las clases Tailwind estén aplicadas y que no haya ruptura de layout en diferentes resoluciones y contrastes.

### Casos de Prueba (Visuales):
1. **Contraste Textual:** 
   - *Paso:* Navegar por todas las vistas principales (Dashboard, Inventario, Ventas, Reportes).
   - *Verificar:* Los textos principales en blanco (`text-white`) y los textos secundarios en grises/azulados (`text-app-textMuted`) son legibles contra el fondo oscuro (`bg-app-bg`).
2. **Responsive Sidebar:**
   - *Paso:* Redimensionar el navegador a tamaño móvil (menor a 768px).
   - *Verificar:* El Sidebar desaparece, aparece un botón tipo hamburguesa, y al pulsarlo, un modal sobrepone el menú deslizante.
3. **Estados Hover Modales:**
   - *Paso:* En "Inventario", pasar el mouse sobre la tarjeta de "Stock Crítico" (Hover intent).
   - *Verificar:* La tarjeta se vuelve de un borde rojizo, y a los 0.5 seg emerge un mini panel flotante detallando qué productos están en alerta sin dañar la tabla inferior.

## 2. Pruebas Funcionales: Módulo de Autenticación

**Objetivo:** Asegurar que el ciclo de vida del usuario (Login, Register, OTP Verification) funciona sin atascos visuales.

### Casos de Prueba:
1. **Validación Visual de Errores (Login):**
   - *Paso:* Ingresa un correo falso. Y trata de hacer submit.
   - *Verificar:* Los mensajes de error de Laravel devuelven una alerta en rojo integrada en lugar de una página 404/500 general, y los inputs toman un ribete rojizo (`border-red-500`).
2. **Animación OTP (Registro/Verificación):**
   - *Paso:* Simula un registro y entra a la pantalla de "Verificación".
   - *Verificar:* Se ven 6 cajas anchas. Al escribir un número en la caja 1, el foco (cursor) debe saltar automáticamente a la caja 2 usando Vanilla JS y así sucesivamente. Al final, el botón de "Verificar Código" debe habilitarse.

## 3. Pruebas Funcionales: Módulo de Inventario

**Objetivo:** Comprobar la correcta comunicación de la vista rediseñada mediante Fetch (AJAX) con el backend `/productos`.

### Casos de Prueba:
1. **Creación Asincrónica:**
   - *Paso:* Abrir "Nuevo Producto". Llenar "Cerveza Test", Precio: 5000, Stock: 20. Categoría: Cervezas. Dar Guardar.
   - *Verificar:* El botón cambia su texto a "Guardando...". Sale un Pop-up verde ("Toast") en pantalla (Esquina inferior) confirmando. El modal se cierra automático, y la tabla se auto-recarga tras unos milisegundos.
2. **Protección de Stock sobre Escritura Múltiple:**
   - *Paso:* Haz clic en "Editar" de un producto (Ej. Stock: 10).
   - *Verificar:* La casilla "Stock Actual" sale opaca (gris oscura) y de solo lectura. El usuario **solo** puede digitar en el bloque verde de "Sumar Stock (+)". 
3. **Flitrado Reactivo:**
   - *Paso:* Escribir "agua" en el buscador text de Inventario.
   - *Verificar:* Tras una leve pausa de 0.4s (Debounce filter JS pre-puesto), la tabla de abajo se actualiza mostrando solo las cadenas coincidentes sin recargar toda la página (`window.location`).

## 4. Pruebas Funcionales: Terminal de Venta (POS)

**Objetivo:** Verificar rigurosamente el paso de valores y límites de compras hacia el servidor.

### Casos de Prueba:
1. **Límite Absoluto de Stock (Frontera Front-end):**
   - *Paso:* Ingresar a "Ventas", Abrir "Nueva Venta".
   - *Paso:* Buscar un producto (Ej. "Ron Viejo") cuyo stock global es 5.
   - *Paso:* Escribir **Cantidad: 6** en el input de carga del carrito.
   - *Verificar:* Al presionar "Añadir", el Toast debe mandar error rojo: "Stock insuficiente (Hay 5)". El producto *NO* debe bajar al carrito.
2. **Incremento en Carrito VS Límite Total:**
   - *Paso:* (Del caso anterior) Buscar "Ron Viejo". Carga cantidad 3 al carrito.
   - *Paso:* En el carrito (tabla inferior), cambiar manualmente la flechita del input del producto y pasarlo de 3 a 6.
   - *Verificar:* El Toast advierte y automáticamente el input retrocede a su valor válido o descarta el excedente alertando al usuario.
3. **Cobro Unificado de Carrito:**
   - *Paso:* Añadir 2 productos al carrito. Seleccionar método "Tarjeta" y "Procesar".
   - *Verificar:* El botón se deactiva (`disabled = true`) para prevenir Doble-Click (Generación de doble factura). Finaliza refrescando la lista de historial que reposa debajo y apareciendo un Toast exitoso.

## 5. Pruebas Funcionales: Reportes y PDF Export

**Objetivo:** Validar calculos lógicos y la librería Canvas a PDF de JS.

### Casos de Prueba:
1. **Reactividad de Fechas:**
   - *Paso:* En `/reportes`, pulsa Seleccionar "Últimos 30 días" en vez de los 7 default.
   - *Verificar:* Reaparece el spiner y los 4 grandes números actualizan todos a cifras mayores.
2. **Exportar Archivo.**
   - *Paso:* Pulsar Exportar Reporte.
   - *Verificar:* La pantalla oscila brevemente, el navegador detiene carga casi 1 seg (Render de JS Canvas por detrás) e insta a descargar un fichero `.pdf`.
   - *Verificar:* Abrir el PDF y contemplar que respeta tipografía blanca sobre un fondo azul nocturno/pizarra oscuro sólido con la tabla incrustada, sin manchas raras de transparencias sobre puestas.
