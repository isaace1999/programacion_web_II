# programacion_web_II Conexión con Base de Datos y Creación Manual del Esquema

Este proyecto PHP permite conectarse a una base de datos MySQL y Pero debe crear el Esquema de forma manual al iniciar la aplicación, usando variables de entorno importadadas directamente del sistema o cargadas desde un archivo `.env`.

# Requisitos

- PHP ≥ 8.0
- MySQL
- Composer (gestor de dependencias para PHP)

# Instalacion paso a paso

### 1. Clona el repositorio

git clone https://github.com/isaace1999/programacion_web_II.git

### 2. Instalar composer

# Windows

Ve a: https://getcomposer.org/download/

Descarga y ejecuta el instalador.

Durante la instalación, selecciona tu archivo php.exe. (Por defecto el detecta tu version de php y su lugar de instalación)

# Linux / macOS

php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php
sudo mv composer.phar /usr/local/bin/composer

# Para verificar la instalación:

composer --version

### 3. Instala las dependencias del proyecto (Esto descargará las librerías necesarias, como vlucas/phpdotenv.)

composer install

### 4. Configura las variables de entorno

Crea un archivo .env en la raíz del proyecto.

Copia y edita el contenido base:

APP_ENV=local
DB_HOST=localhost
DB_NAME=organizacion
DB_USER=root
DB_PASS=tu_contraseña

### 5. Verifica que todo este funcionando bien
