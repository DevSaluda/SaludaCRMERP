# Saluda CRM-ERP

Sistema de gestión para hospitales y licencias médicas.

## Requisitos del sistema

- PHP 7.3 / 8.0
- MySQL 5.7 o superior
- Composer 2.x
- Extensiones PHP: BCMath, Ctype, Fileinfo, JSON, Mbstring, OpenSSL, PDO, Tokenizer, XML

## Instrucciones de deployment en Hostinger

### Método 1: Deployment Automático (Recomendado)

1. **Clonar el repositorio en Hostinger**
   ```bash
   cd public_html
   rm -rf * .*
   git clone https://github.com/DevSaluda/SaludaCRMERP.git .
   ```

2. **Ejecutar el script de deployment**
   ```bash
   chmod +x deploy.sh
   ./deploy.sh
   ```

3. **Configurar archivo .env**
   - Edita el archivo `.env` con tus credenciales de base de datos y configuración de correo
   - Asegúrate de que `APP_URL` esté configurado a tu dominio

4. **Ejecutar migraciones**
   ```bash
   php artisan migrate --force
   php artisan db:seed --force
   ```

### Método 2: Deployment Manual

1. **Subir archivos por FTP**
   - Descarga los archivos del repositorio a tu computadora
   - Sube todos los archivos EXCEPTO `/vendor/` y `composer.lock`

2. **Configuración en el servidor**
   ```bash
   cd public_html
   cp .env.example .env
   # Edita .env con tu configuración
   
   # Instala dependencias
   curl -sS https://getcomposer.org/installer | php
   php composer.phar install --no-dev --no-scripts --ignore-platform-reqs
   
   # Genera clave
   php artisan key:generate
   
   # Optimización
   php artisan optimize
   
   # Migraciones
   php artisan migrate --force
   php artisan db:seed --force
   
   # Permisos
   chmod -R 755 .
   chmod -R 777 storage bootstrap/cache
   ```

## Solución de problemas

### Error de memoria al instalar dependencias
```bash
php -d memory_limit=-1 composer.phar install --no-dev
```

### Error con PHP version
Asegúrate de estar utilizando PHP 8.0 o superior:
```bash
php -v
```

### Error con composer.lock
```bash
rm composer.lock
composer install --no-dev
```

## Usuarios por defecto

- **Administrador**: admin@saludamedica.com (contraseña: admin123)
- **Recepción**: recepcion@saludamedica.com (contraseña: saluda2025)

## Estructura del proyecto

- `/app` - Código principal de la aplicación
- `/database` - Migraciones y seeders
- `/resources` - Vistas y assets
- `/routes` - Definición de rutas
