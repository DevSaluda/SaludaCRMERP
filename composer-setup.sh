#!/bin/bash

# Script para configurar Composer en Hostinger

# Eliminar archivos que pueden causar conflictos
rm -f composer.lock

# Descargar Composer 2
curl -sS https://getcomposer.org/installer | php -- --2

# Mover composer.phar a una ubicación accesible
mv composer.phar composer

# Dar permisos de ejecución
chmod +x composer

# Actualizar configuración
./composer config --global process-timeout 3000
./composer config --global optimization-level 2

# Instalar dependencias directamente desde composer.json (no usar el lock)
./composer install --no-dev --optimize-autoloader --no-plugins --no-scripts --ignore-platform-reqs

# Mostrar información
echo "Composer 2 instalado correctamente."
echo "Usa './composer' para ejecutar comandos." 