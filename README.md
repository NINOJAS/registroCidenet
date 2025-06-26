# Registro Cidenet

Sistema de registro de empleados para Cidenet S.A.S. Desarrollado con Laravel (PHP) en el backend, Blade para la capa de vistas y TailwindCSS junto a Alpine.js para el frontend.

Instructivo de Despliegue Local
Este documento detalla el procedimiento técnico para la instalación y ejecución de la solución.

1. Requisitos previos
   Asegure la disponibilidad de los siguientes componentes:

Servidor web: Apache / Nginx.
PHP: Versión ^8.1.
Base de datos: MySQL ^5.7/MariaDB ^10.2.
Compositor: Gestor de dependencias PHP.
Node.js & npm/Yarn: Para gestión y compilación de activos frontend.
Gestor Integrado (Opcional): XAMPP / WAMP / MAMP.

2. Pasos de instalación

2.1 Clonar repositorio:
git clone <URL_DEL_REPOSITORIO> registroCidenet && cd registroCidenet

2.2 Instalar Dependencias Backend:
composer install

2.3 Configurar entorno ( .env):
cp .env.example .env
Edite el archivo .env ajustando las siguientes variables:
APP_URL: Configure la URL de acceso local (p. ej., http://registroCidenet.testo http://localhost/registroCidenet/public).
DB_DATABASE: Defina el nombre de su base de datos local (por ejemplo, registroCidenet).
DB_USERNAME:Usuario de MySQL.
DB_PASSWORD: Contraseña de MySQL.

2.4 Generar APP_KEY:
php artisan key:generate

2.5 Configurar y Migrar Base de Datos:
Cree la base de datos MySQL con el nombre especificado en DB_DATABASE(por ejemplo, registroCidenet) a través de phpMyAdmin o un cliente CLI.
Ejecutar las migraciones de base de datos:
php artisan migrate

2.6 Instalar y compilar activos frontend:
npm install
npm run dev

3. Acceso a la aplicación
   3.1 Asegúrese de que los servicios de servidor web (Apache) y base de datos (MySQL) estén operativos.
   3.2 Acceda a la aplicación mediante la URL configurada en APP_URL(p.ej., http://localhost/registroCidenet/publico http://registroCidenet.test).

4. Diagnóstico de Problemas (Solución de problemas)
   HTTP 500 / storage/logs/laravel.log: Revisar permisos de escritura en storage/y bootstrap/cache/.
   Errores de Conexión DB: Verificar estado del servicio MySQL y credenciales en .env.
   Estilos/JS no cargan: Confirmar ejecución de npm instally npm run dev/build.
