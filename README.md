# Examen Técnico: Sistema de Gestión de Tareas

## Descripción General 
El candidato deberá desarrollar una pequeña aplicación web de gestión de tareas, donde se puedan agregar, visualizar y eliminar tareas. Cada tarea tendrá un título, descripción, prioridad y estado (pendiente o completada). Los datos deben almacenarse en una base de datos MySQL, y el proyecto debe seguir la estructura de un sistema CRUD básico para las tareas. El sistema debe permitir a los usuarios iniciar sesión mediante un login con usuario y contraseña, pero no es necesario encriptar la contraseña, y no es necesario crear un CRUD para los usuarios.

## Archivos

### login.html
Página de inicio de sesión para los usuarios.

### Estructura de Carpetas
El proyecto tiene la siguiente estructura de carpetas:

- **carpeta - administrativo**
  - **carpeta - Js**
    - `FuncionesDashboard.js`: Contiene funciones para manejar las peticiones relacionadas con el dashboard, como cargar tareas y actualizar su estado.
    - `FuncionesTareas.js`: Contiene funciones para manejar las peticiones relacionadas acerca de la gestion de las tareas, asi como el guardado, actualizado, eliminado y la consulta.
  - `dashboard.php`: Muestra un conteo de tareas pendientes y completadas a través de tarjetas, además de listar todas las tareas existentes, permitiendo editar su estado.
  - `tareas.php`: Realiza las operaciones CRUD (Consultar, Leer, Actualizar y Eliminar) para las tareas.

- **carpeta - conexion**: Carpeta que contiene los archivos relacionados con la conexión a la base de datos MySQL.
   - `conexion.php`: Contiene las credenciales de la base de datos MySQL.

- **carpeta - controller**: Carpeta que incluye los archivos que manejan la lógica del negocio para la aplicación.
   - **carpeta - crud**
     - `tareas-save.php`: Se encarga de manejar la creación de nuevas tareas en el sistema de gestión de tareas.
     - `tareas-update.php`: Se encarga de manejar la actualización de tareas existentes en el sistema de gestión de tareas.
     - `tareas-delete.php`: Se encarga de manejar la eliminación de tareas en el sistema de gestión de tareas.
     - `tareas-list.php`: Se encarga de obtener y listar las tareas asociadas al usuario autenticado en el sistema de gestión de tareas.
     - `tareas-get.php`: Se encarga de obtener los detalles de una tarea específica en el sistema de gestión de tareas, utilizando el ID de la tarea proporcionado en la solicitud.
 - **carpeta - dashboard**
   - `dashboard-list.php`: Se encarga de obtener todas las tareas de un usuario autenticado, así como el conteo de tareas pendientes y completadas, devolviendo esta información en formato JSON.
   - `dashboard-update.php`: Se encarga de actualizar el estado de una tarea específica en el sistema de gestión de tareas para un usuario autenticado, devolviendo un mensaje de éxito o error en formato JSON.
 
 - `login.php`: Maneja el proceso de inicio de sesión para usuarios en el sistema de gestión de tareas, verificando las credenciales y estableciendo una sesión para el usuario autenticado.
 - `sesion.php`: Se encarga de cerrar la sesión del usuario, eliminando todos los datos de la sesión y redirigiendo al usuario a la página de inicio de sesión.

- **css**: Carpeta donde se encuentran los estilos CSS del proyecto.

- **js**: Carpeta que contiene archivos JavaScript adicionales que soportan la funcionalidad de la aplicación.
  - `FuncionesLogin.js`: Maneja el proceso de inicio de sesión de los usuarios, enviando los datos del formulario al servidor y gestionando la respuesta para redirigir al usuario a la página de dashboard si la autenticación es exitosa.

- **template**: Carpeta que incluye plantillas de vista que pueden ser utilizadas en diferentes partes del sistema.
  - `plantilla-dashboard.php`: Plantilla hecha con boostrap, para el manejo del dashboard y diferentes pestañas.
 
- **CreacionDeLaBaseDeDatos.sql**: Contiene la creación de la base de datos, tablas, y los inserts de las respectivas tablas

## Funcionalidades

- **Dashboard**: Muestra un resumen visual de las tareas en tarjetas, indicando cuántas están pendientes y cuántas están completadas. Permite marcar tareas como completadas o eliminarlas.

- **CRUD de Tareas**: Permite realizar las operaciones básicas de gestión de tareas: crear nuevas tareas, listar las existentes, editar detalles de tareas seleccionadas y eliminar tareas.

- **Interacción**: La aplicación utiliza peticiones fetch para interactuar con los archivos de controlador, lo que permite actualizar la interfaz de usuario sin recargar la página.

## Requisitos
- Base de datos MySQL para almacenar las tareas.
- Servidor web para ejecutar el código PHP.
