#!/bin/bash

# Script para corregir problemas de composer.lock en Hostinger

# Eliminar el archivo lock
echo "Eliminando composer.lock..."
rm -f composer.lock

# Instalar dependencias directamente desde composer.json
echo "Instalando dependencias desde composer.json..."
php -d memory_limit=-1 composer install --no-dev --optimize-autoloader --no-plugins --no-scripts --ignore-platform-reqs

# Limpiar caché de Composer
echo "Limpiando caché de Composer..."
php -d memory_limit=-1 composer clear-cache

echo "Proceso completado. Ahora puedes continuar con los siguientes pasos:"
echo "1. Configurar el archivo .env"
echo "2. Generar clave de aplicación (php artisan key:generate)"
echo "3. Ejecutar migraciones (php artisan migrate --force)" 