# Tienda Online de Zapatillas – PHP & MySQL (MVC)

Proyecto académico del módulo **Desarrollo Web en Entorno Servidor**  

---

## Introducción

Este proyecto consiste en el desarrollo de una **tienda online para la venta de zapatillas de deporte**, implementada siguiendo una **arquitectura Modelo–Vista–Controlador (MVC)** y diferenciando claramente las tres capas del sistema:

- **Capa cliente**: HTML, CSS y JavaScript  
- **Capa de lógica de negocio**: PHP  
- **Capa de acceso a datos**: PHP y MySQL  

Para la planificación del desarrollo se ha utilizado **Jira**, organizando el trabajo en **sprints de dos semanas** con historias y tareas, y **Confluence** para la documentación de requisitos y seguimiento del proyecto.

La aplicación cumple con todos los requisitos exigidos y con las tres funcionalidades principales definidas en el enunciado.

---

## Funcionalidades implementadas

### RF01 – Gestión de usuarios (Administrador)
- Crear, modificar y eliminar usuarios
- Gestión de usuarios con rol **admin** y **client**

### RF02 – Gestión de productos (Administrador)
- Crear, editar y eliminar productos de la tienda
- Actualización inmediata de los artículos visibles en la tienda

### RF03 – Compra de productos (Cliente)
- Navegación y visualización de productos
- Añadir productos al carrito
- Confirmar compra
- Consulta del historial de pedidos y detalle de cada pedido

---

## Arquitectura MVC y 3 capas

Se ha implementado una arquitectura **Modelo–Vista–Controlador** estructurada de la siguiente forma:

### Modelo
- Contiene la lógica de acceso a datos (consultas, inserciones, actualizaciones, borrados)
- Modelos creados:
  - `UserModel`
  - `ProductModel`
  - `OrderModel`
- Ubicación: `app/models`

### Vista
- Contiene exclusivamente código HTML/PHP para la presentación
- No accede directamente a la base de datos
- Ubicación: `app/views`

### Controlador
- Recibe la petición del usuario
- Llama al modelo correspondiente
- Decide qué vista cargar
- Gestiona validaciones y redirecciones
- Ubicación: `app/controllers`

### Puntos de entrada públicos
- Únicas URLs accesibles desde el navegador
- Cargan la conexión a la base de datos y el controlador correspondiente
- Ubicación: `public/`

---

## Navegación por roles

### Usuario Administrador
- Puede acceder a la **home** para visualizar productos
- Tras iniciar sesión como **admin**, accede al **gestor**
- Funcionalidades disponibles:
  - Gestión completa de usuarios (CRUD)
  - Gestión completa de productos (CRUD)
- **No puede acceder** al carrito ni al historial de pedidos de clientes

### Usuario Cliente
- Puede acceder a la **home** y visualizar productos
- Puede registrarse o iniciar sesión
- Funcionalidades disponibles:
  - Añadir productos al carrito
  - Finalizar compra
  - Consultar historial de pedidos
  - Ver detalle de pedidos
- **No puede acceder** al gestor de usuarios ni productos

---

## Base de datos

Base de datos: **shoe_store**

### users
- PK: `user_id`
- Atributos: nombre, email, contraseña, rol, fecha_creación
- Relación: un usuario puede realizar uno o varios pedidos

### products
- PK: `product_id`
- Atributos: nombre, precio, stock, descripción
- Relación: un producto puede aparecer en varios pedidos

### orders
- PK: `order_id`
- FK: `user_id`
- Atributos: total del pedido, fecha_creación
- Relación: pertenece a un único usuario

### order_items
- PK: `order_item_id`
- FK: `order_id`, `product_id`
- Atributos: cantidad, precio por artículo
- Entidad intermedia entre pedidos y productos

---

## Tecnologías utilizadas

- PHP
- MySQL
- HTML5
- CSS3
- JavaScript
- Jira (planificación)
- Confluence (documentación)
- Git / GitHub

---

## Autor

Creado por Laura Trillo
Desarrollo Web en Entorno Servidor – DAW
