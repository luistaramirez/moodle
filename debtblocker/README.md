# Debt Blocker for Moodle

**Debt Blocker** es un plugin local para Moodle que suspende o desbloquea automáticamente a los usuarios según su estado de deuda, consultando una API externa cada vez que inician sesión.

---

## Características

- Suspende usuarios con deudas al iniciar sesión.
- Desbloquea usuarios automáticamente si ya no tienen deuda.
- Integración sencilla con cualquier API REST externa que devuelva el estado de deuda.

---

## Instalación

1. Copia la carpeta `debtblocker` en el directorio `local/` de tu instalación de Moodle.
2. Modifica la URL de la API en `lib.php` para apuntar a tu servicio real.
3. Accede como administrador a tu sitio Moodle para completar la instalación del plugin.

---

## Configuración

- La URL de la API debe devolver un JSON con la clave `deuda`, por ejemplo:
  ```json
  { "deuda": true }
  ```
- El plugin consulta la API usando el nombre de usuario de Moodle como parámetro.

---

## Funcionamiento

1. Cuando un usuario inicia sesión, el plugin consulta la API externa.
2. Si la respuesta indica deuda (`deuda: true`), el usuario es suspendido.
3. Si no hay deuda (`deuda: false`), el usuario es desbloqueado si estaba suspendido.

---

## Requisitos

- Moodle 4.3 o superior.
- Acceso a una API externa que devuelva el estado de deuda del usuario.

---

## Personalización

- Puedes modificar la lógica de suspensión/desbloqueo en `lib.php`.
- Para agregar más idiomas, crea archivos en la carpeta `lang/`.

---

## Limitaciones

- No maneja errores de conexión ni respuestas inválidas de la API.
- No notifica al usuario si su cuenta fue suspendida/desbloqueada.
- Se recomienda agregar manejo de errores y logs para producción.

---

## Licencia

Este plugin se distribuye bajo la licencia [GPL v3](https://www.gnu.org/licenses/gpl-3.0.html).

---

## Autor

Desarrollado por luistaramirez.