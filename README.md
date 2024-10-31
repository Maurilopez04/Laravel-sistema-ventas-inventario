# **Sistema de Gestión de Inventario y Ventas**

Este sistema es una aplicación desarrollada en Laravel diseñada para la gestión integral de inventarios, ventas, proveedores, clientes y empleados. Actualmente, el sistema ofrece funcionalidades básicas de CRUD para diferentes entidades y control de stock en múltiples almacenes. A continuación, se describen las características ya implementadas y las que están en desarrollo.

## Funcionalidades Actuales

### 1. Autenticación de Usuarios:

- Implementada mediante Laravel Breeze.
- Permite registro, inicio de sesión, restablecimiento de contraseña y gestión de perfiles de usuario.
### 2. CRUD de Entidades Básicas:

- Categorías: Administración de categorías de productos.
- Marcas: Administración de marcas de productos.
- Productos: Administración de productos, con soporte para detalles como nombre, descripción, precio, etc.
- Clientes: Administración de clientes, permitiendo mantener registros de cada cliente.
- Proveedores: Administración de proveedores, con toda la información de contacto y datos relevantes.
- Almacenes: Administración de almacenes, que permite gestionar distintos puntos de almacenamiento de inventario.
### 3. Control de Stock por Almacenes:

- Permite gestionar la cantidad de productos en cada almacén.
- Mantiene actualizaciones del stock en cada almacén de forma separada.

## Funcionalidades en Desarrollo

### 1. CRUD de Cajas:

Administración de cajas registradoras y control de cada caja.
### 2. Movimiento de Caja:

Registro de entradas y salidas de efectivo en cada caja.
### 3. Compras:

Gestión de compras, incluyendo detalles de cada compra.
Actualización automática del stock y del movimiento de caja basado en las compras realizadas.
### 4. Ventas:

Gestión de ventas, con detalles de cada transacción de venta.
Modificación automática del stock y del movimiento de caja en base a las ventas.
### 5. CRUD de Empleados:

Administración de empleados con detalles de información personal y laboral.
### 6. Transacciones de Empleados:

Registro de transacciones financieras relacionadas con empleados, como pagos y descuentos.
Actualización automática de los movimientos de caja según las transacciones de empleados.

## Mejoras Futuras

- Métodos de Pago: Incorporación de diferentes opciones de pago.
- Bancos: Gestión de cuentas bancarias y transacciones relacionadas.
- Sucursales: Administración de múltiples sucursales para una gestión más completa.
- Roles y Permisos: Implementación de un sistema de roles para gestionar permisos de acceso según el rol de usuario.
