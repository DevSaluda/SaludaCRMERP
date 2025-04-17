#!/bin/bash

# Script para configurar Composer en Hostinger

# Descargar Composer 2
curl -sS https://getcomposer.org/installer | php -- --2

# Mover composer.phar a una ubicación accesible
mv composer.phar composer

# Dar permisos de ejecución
chmod +x composer

# Actualizar configuración
./composer config --global process-timeout 3000
./composer config --global optimization-level 2

# Instalar dependencias con PHP 8.0
./composer install --no-dev --optimize-autoloader --no-plugins --no-scripts

# Mostrar información
echo "Composer 2 instalado correctamente."
echo "Usa './composer' para ejecutar comandos." 