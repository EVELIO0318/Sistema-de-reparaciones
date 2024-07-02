# Sistema-de-reparaciones

Sistema desarrollado por el Ing. Evelio Escobar para un taller de reparación de Computadoras y hardware.

## ✨ Descripción

El **Sistema-de-reparaciones** es una aplicación diseñada para gestionar las reparaciones de computadoras y hardware en un taller especializado. Permite registrar y seguir el progreso de las reparaciones, gestionar inventarios de piezas, y mantener un historial de los servicios prestados a cada cliente.

## 🛠 Tech Stack

### Lenguajes y Tecnologías

- ![CSS3](https://img.shields.io/badge/-CSS3-1572B6?logo=css3&logoColor=white)
- ![PHP](https://img.shields.io/badge/-PHP-777BB4?logo=php&logoColor=white)
- ![Node.js](https://img.shields.io/badge/-Node.js-339933?logo=node.js&logoColor=white)
- ![JavaScript](https://img.shields.io/badge/-JavaScript-F7DF1E?logo=javascript&logoColor=black)
- ![MySQL](https://img.shields.io/badge/-MySQL-4479A1?logo=mysql&logoColor=white)
- ![MariaDB](https://img.shields.io/badge/-MariaDB-003545?logo=mariadb&logoColor=white)

## 🚀 Instalación

1. Clona el repositorio:
    ```bash
    git clone https://github.com/EVELIO0318/Sistema-de-reparaciones.git
    ```
2. Navega al directorio del proyecto:
    ```bash
    cd Sistema-de-reparaciones
    ```
3. Instala las dependencias:
    ```bash
    composer install
    npm install
    ```
4. Configura el archivo `.env`:
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
5. Ejecuta las migraciones y seeders:
    ```bash
    php artisan migrate --seed
    ```
6. Inicia el servidor de desarrollo:
    ```bash
    php artisan serve
    ```

## 📚 Uso

Una vez instalado, puedes acceder al sistema a través de `http://localhost:8000` y comenzar a gestionar las reparaciones.

## 🤝 Contribuir

Si deseas contribuir a este proyecto, por favor sigue los siguientes pasos:

1. Haz un fork del repositorio.
2. Crea una rama con tu nueva funcionalidad (`git checkout -b feature/nueva-funcionalidad`).
3. Haz commit de tus cambios (`git commit -am 'Agrega nueva funcionalidad'`).
4. Haz push a la rama (`git push origin feature/nueva-funcionalidad`).
5. Crea un nuevo Pull Request.

## 📄 Licencia

Este proyecto está bajo la Licencia MIT. Consulta el archivo [LICENSE](LICENSE) para más detalles.
