# Instrucciones para Deployment en Hostinger (PHP 8.0)

## Preparación local

1. **Actualiza composer.json**
   - Asegúrate de que el archivo composer.json es compatible con PHP 8.0 (ya actualizado)
   - La versión de Laravel debe ser 8.x, no 9.x ni 10.x que requieren PHP 8.1+

2. **Sube los cambios al repositorio**
   ```bash
   git add composer.json
   git commit -m "Actualizar composer.json para PHP 8.0"
   git push origin master
   ```

## Opción 1: Deployment Manual en Hostinger (Recomendado)

1. **Iniciar sesión en Hostinger**
   - Accede al panel de control de Hostinger
   - Ve a la sección "Hosting"
   - Selecciona tu dominio `saludaweb.com`

2. **Subir archivos del proyecto**
   - Descarga los archivos del repositorio a tu computadora
   - Sube todos los archivos del proyecto EXCEPTO:
     - `/vendor/`
     - `composer.lock`
     - `.env` (lo crearás después)
   - Usa el administrador de archivos de Hostinger o FTP

3. **Conectarse por SSH**
   - Esto facilitará la ejecución de comandos siguientes
   - Si no tienes acceso SSH, usa la terminal integrada en el panel de Hostinger

4. **Configurar Composer**
   ```bash
   cd public_html
   chmod +x composer-setup.sh
   ./composer-setup.sh
   ```

5. **Configurar el archivo .env**
   - Crear el archivo `.env` con la configuración correcta:
     ```bash
     cp .env.example .env
     nano .env  # o usa el editor de archivos web
     ```
   - Actualiza:
     - `APP_URL=https://saludaweb.com`
     - Configuración de base de datos (DB_*)
     - Configuración de correo (MAIL_*)

6. **Generar clave de aplicación**
   ```bash
   php artisan key:generate
   ```

7. **Ejecutar migraciones**
   ```bash
   php artisan migrate --force
   ```

8. **Optimizar la aplicación**
   ```bash
   php artisan optimize:clear
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

9. **Verificar permisos**
   ```bash
   chmod -R 755 .
   chmod -R 777 storage bootstrap/cache
   ```

## Opción 2: Deployment usando Git

Si prefieres usar Git directamente en el servidor:

1. **Accede a tu cuenta Hostinger por SSH**

2. **Navega al directorio donde quieres instalar la aplicación**
   ```bash
   cd public_html
   ```

3. **Elimina cualquier archivo conflictivo**
   ```bash
   rm -f composer.lock
   ```

4. **Si ya existe un repositorio Git:**
   ```bash
   git fetch origin
   git reset --hard origin/master
   ```

5. **Si no existe un repositorio Git:**
   ```bash
   git init
   git remote add origin https://github.com/DevSaluda/SaludaCRMERP.git
   git pull origin master
   ```

6. **Configurar Composer**
   ```bash
   chmod +x composer-setup.sh
   ./composer-setup.sh
   ```

7. **Sigue los pasos 5-9 de la Opción 1**

## Solución de problemas comunes

### Error de PHP Version
Si ves errores relacionados con la versión de PHP, verifica:
- La versión de PHP en Hostinger (debe ser 8.0+)
- La versión de Laravel en composer.json (debe ser 8.x para PHP 8.0)

### Error al instalar dependencias
Usa el script composer-setup.sh o intenta:
```bash
php -d memory_limit=-1 $(which composer) install --no-dev --optimize-autoloader --no-plugins --no-scripts
```

### Error con las migraciones
Si las migraciones fallan, verifica:
- La conexión a la base de datos en el archivo `.env`
- Que la base de datos exista y el usuario tenga permisos 