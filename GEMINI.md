Proyecto: DAVI RAPI – Sistema de Gestión de Operaciones
🧠 1. Propósito del Sistema

DAVI RAPI es un sistema de gestión diseñado para negocios de comida rápida que operan tanto en punto físico como con servicio a domicilio.

El sistema tiene como objetivo principal:

Centralizar la administración del negocio
Controlar ingresos, gastos y rentabilidad
Gestionar productos del menú
Registrar y controlar pedidos
Administrar repartidores
Proporcionar métricas claras para la toma de decisiones

El enfoque del sistema es operativo, financiero y logístico en una sola plataforma.

🏗️ 2. Estructura General del Sistema

El sistema se divide en los siguientes módulos principales:

- Autenticación
- Resumen (Dashboard)
- Menú (Productos)
- Ventas (Pedidos)
- Repartidores
- Gastos

Cada módulo cumple una función específica dentro del flujo del negocio.

🔐 3. Módulo de Autenticación
Objetivo:

Controlar el acceso al sistema.

Funcionalidades:
Inicio de sesión de usuarios
Manejo de sesión activa
Cierre de sesión
Reglas:
Solo usuarios autenticados pueden acceder al sistema
Algunos permisos (como eliminar datos sensibles) deben estar restringidos a roles administrativos
📊 4. Módulo de Resumen (Dashboard)
Objetivo:

Visualizar el estado general del negocio en tiempo real.

Funcionalidades:
Métricas principales:
Total de ingresos (ventas)
Número de pedidos realizados
Total de gastos
Balance neto (ingresos - gastos)
Filtro por fechas:
El usuario puede seleccionar un rango de fechas
Toda la información se recalcula en base a ese rango
Análisis de ventas:
Visualización de ventas agrupadas por día
Permite identificar tendencias
Ranking de repartidores:
Lista de repartidores ordenados por desempeño
Métricas:
Cantidad de pedidos entregados
Total generado en ventas
🍔 5. Módulo de Menú (Productos)
Objetivo:

Administrar los productos disponibles para la venta.

Funcionalidades:
Registro de productos:

Cada producto debe incluir:

Identificador único (referencia)
Nombre
Precio
Descripción
Imagen (opcional)
Estado (disponible / no disponible)
Gestión:
Crear productos
Editar productos
Eliminar productos
Activar/desactivar disponibilidad
Reglas:
Solo productos disponibles pueden ser vendidos
El identificador debe generarse automáticamente
🧾 6. Módulo de Ventas (Pedidos)
Objetivo:

Registrar y controlar todas las ventas del negocio.

Funcionalidades:
Registro de pedido:

Cada venta debe incluir:

Producto
Cantidad
Tipo de venta:
Local
Domicilio
Costo de envío (si aplica)
Cliente:
Nombre
Celular
Dirección (opcional)
Repartidor (solo si es domicilio)
Cálculo automático:
Total = (precio del producto × cantidad) + envío
Registro de fecha:
Fecha y hora de la venta
Gestión:
Visualizar listado de pedidos
Eliminar pedidos
Reglas:
Si el pedido es a domicilio, debe asignarse un repartidor
Si es local, no requiere repartidor
🛵 7. Módulo de Repartidores
Objetivo:

Gestionar el personal encargado de las entregas.

Funcionalidades:
Registro:
Identificador único
Nombre
Apellido
Celular
Gestión:
Crear repartidores
Listar repartidores
Eliminar repartidores
Reglas:
Los repartidores pueden ser asignados a pedidos
Solo usuarios con permisos adecuados pueden eliminarlos
💸 8. Módulo de Gastos
Objetivo:

Registrar todas las salidas de dinero del negocio.

Funcionalidades:
Registro de gasto:
Descripción
Monto
Fecha
Gestión:
Listar gastos
Eliminar gastos
Impacto:
Los gastos afectan directamente el balance del sistema
🧮 9. Lógica de Negocio
Cálculos principales:
Ingresos: suma de todas las ventas
Gastos: suma de todos los egresos
Balance: ingresos - gastos
Filtros:
Todos los cálculos deben poder filtrarse por rango de fechas
Agrupaciones:
Ventas agrupadas por día
Pedidos agrupados por repartidor
Ranking:
Ordenar repartidores por:
Número de pedidos
Total generado
🔗 10. Relación entre Módulos
Un producto puede estar en muchas ventas
Una venta puede tener:
Un producto
Un cliente
Un repartidor (opcional)
Un repartidor puede tener muchas ventas
Los gastos son independientes pero afectan el balance general
⚠️ 11. Reglas del Sistema
No se pueden registrar ventas sin producto válido
No se pueden registrar ventas a domicilio sin repartidor
El precio del producto debe ser numérico y mayor a cero
Los gastos deben ser valores positivos
El sistema debe garantizar consistencia en los cálculos financieros
🚀 12. Enfoque para Implementación en CakePHP

Este documento define la base funcional para construir:

Modelos (Productos, Ventas, Repartidores, Gastos, Usuarios)
Controladores por módulo
Relaciones entre entidades
Validaciones de negocio
Vistas para gestión administrativa

El sistema debe diseñarse pensando en:

Escalabilidad
Separación de lógica
Seguridad en autenticación
Persistencia en base de datos
🧩 13. Conclusión

DAVI RAPI es un sistema integral de gestión que combina:

Operación diaria (ventas)
Administración (productos y repartidores)
Control financiero (gastos y balance)
Análisis (dashboard)

Está pensado para crecer desde una solución básica hasta una plataforma completa empresarial.