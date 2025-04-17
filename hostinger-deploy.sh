#!/bin/bash

# Script para preparar el deployment en Hostinger

# Eliminar archivos que podrían causar conflictos
rm -f composer.lock

# Hacer pull desde el repositorio limpiamente
git pull origin master --force

# Instalar dependencias
composer install --no-dev --optimize-autoloader

# Generar clave de aplicación si no existe
php artisan key:generate --force

# Optimizar la aplicación
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Correr migraciones (con precaución)
# php artisan migrate --force

echo "Deployment completado con éxito." 