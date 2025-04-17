#!/bin/bash

# Deploy script para Hostinger con PHP 8.0
echo "Iniciando deployment en Hostinger..."

# Eliminar archivos que podrían causar conflictos
echo "Eliminando archivos que podrían causar conflictos..."
rm -f composer.lock
rm -rf vendor

# Crear .env si no existe
if [ ! -f .env ]; then
    echo "Creando archivo .env..."
    cp .env.example .env
fi

# Instalar Composer 2
echo "Instalando Composer 2..."
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php --quiet
php -r "unlink('composer-setup.php');"
mv composer.phar composer
chmod +x composer

# Configuración PHP para memoria
export PHP_INI_SCAN_DIR=/dev/null

# Instalar dependencias con PHP settings modificados
echo "Instalando dependencias..."
php -d memory_limit=-1 ./composer install --no-dev --no-interaction --prefer-dist --no-scripts --ignore-platform-reqs

# Generar clave de aplicación si está vacía
if grep -q "APP_KEY=base64:" .env; then
    echo "La clave de aplicación ya existe."
else
    echo "Generando clave de aplicación..."
    php artisan key:generate --force
fi

# Optimizar la aplicación
echo "Optimizando la aplicación..."
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Configurar permisos
echo "Configurando permisos..."
chmod -R 755 .
chmod -R 777 storage bootstrap/cache

echo "¡Deployment completado con éxito!"
echo "Información importante:"
echo "1. Verifica la configuración de la base de datos en .env"
echo "2. Para ejecutar migraciones: php artisan migrate --force" 