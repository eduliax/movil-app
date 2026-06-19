FROM php:8.2-apache

# 1. Instalamos la extensión de MySQL
RUN docker-php-ext-install pdo pdo_mysql

# 2. Copiamos obligatoriamente todos los archivos (como login.php) al directorio web de Apache
COPY . /var/www/html/

# 3. Abrimos el puerto estándar
EXPOSE 80
