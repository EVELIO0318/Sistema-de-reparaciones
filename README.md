# 📱 Sistema de Reparaciones

![Laravel](https://img.shields.io/badge/Laravel-v8.0-red) ![PHP](https://img.shields.io/badge/PHP-7.4-blue) ![MySQL](https://img.shields.io/badge/MySQL-5.7.32-orange)

Este proyecto es un sistema de gestión de reparaciones, desarrollado con Laravel y MySQL. Permite registrar, gestionar y hacer seguimiento a las reparaciones de equipos electrónicos.

## 📋 Tabla de Contenidos
- [Instalación](#⚙️-instalación)
- [Uso](#🚀-uso)
- [Características](#✨-características)
- [Tecnologías](#🛠️-tecnologías)
- [Contribuciones](#🤝-contribuciones)
- [Licencia](#📄-licencia)
- [Contacto](#📧-contacto)

## ⚙️ Instalación

1. Clona el repositorio:
    ```bash
    git clone https://github.com/EVELIO0318/Sistema-de-reparaciones.git
    ```
2. Instala las dependencias:
    ```bash
    composer install
    npm install
    npm run dev
    ```
3. Configura el archivo `.env`:
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
4. Configura la base de datos en el archivo `.env`:
    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nombre_base_de_datos
    DB_USERNAME=tu_usuario
    DB_PASSWORD=tu_contraseña
    ```
5. Ejecuta las migraciones:
    ```bash
    php artisan migrate
    ```

## 🚀 Uso

1. Inicia el servidor local:
    ```bash
    php artisan serve
    ```
2. Accede a la aplicación en tu navegador:
    ```
    http://127.0.0.1:8000
    ```

## ✨ Características

- Gestión de usuarios y roles
- Registro y seguimiento de reparaciones
- Notificaciones por correo electrónico
- Informes y estadísticas

## 🛠️ Tecnologías

- [Laravel](https://laravel.com/)
- [PHP](https://www.php.net/)
- [MySQL](https://www.mysql.com/)
- [JavaScript](https://developer.mozilla.org/en-US/docs/Web/JavaScript)
- [Tailwind CSS](https://tailwindcss.com/)

## 🤝 Contribuciones

¡Las contribuciones son bienvenidas! Si deseas contribuir, por favor sigue estos pasos:

1. Haz un fork del proyecto.
2. Crea una nueva rama (`git checkout -b feature/nueva-funcionalidad`).
3. Realiza tus cambios y haz commit (`git commit -am 'Añadir nueva funcionalidad'`).
4. Sube los cambios a tu rama (`git push origin feature/nueva-funcionalidad`).
5. Abre un Pull Request.

## 📄 Licencia

Este proyecto está licenciado bajo la Licencia MIT. Para más detalles, consulta el archivo [LICENSE](LICENSE).

## 📧 Contacto

Evelio Escobar - [tu-email@example.com](mailto:tu-email@example.com)

¡Gracias por visitar nuestro proyecto!
