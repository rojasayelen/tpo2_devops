# Usa la imagen base de PHP con Apache que ya funciona
FROM php:8.4-apache

# 1. Instalar la extensión MySQLi que necesitamos
# Esto es esencial porque tu index.php usa mysqli para la conexión
# Se usa la herramienta oficial de Docker para extensiones
RUN apt-get update && \
    apt-get install -y libmariadb-dev && \
    rm -rf /var/lib/apt/lists/* && \
    docker-php-ext-install mysqli

# 2. Copiar los archivos de tu aplicación web al directorio de Apache
# La carpeta de trabajo para Apache en esta imagen es /var/www/html/
# El '.' se refiere a la carpeta donde está este Dockerfile (tu carpeta 'devops')
COPY . /var/www/html/

# Exponer el puerto de Apache (el puerto 80 ya está configurado en esta imagen base)
EXPOSE 80

# El comando de inicio ya está definido en la imagen base (httpd -D FOREGROUND)