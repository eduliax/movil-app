FROM php:8.2-apache

# Instalamos la extensión pdo_mysql requerida para conectar bases de datos
RUN docker-php-ext-install pdo pdo_mysql

# Exponemos el puerto estándar web
EXPOSE 80
