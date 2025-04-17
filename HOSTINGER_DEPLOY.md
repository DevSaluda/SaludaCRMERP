# Instrucciones para Deployment en Hostinger

## Opción 1: Deployment Manual

1. **Iniciar sesión en Hostinger**
   - Accede al panel de control de Hostinger
   - Ve a la sección "Hosting"
   - Selecciona tu dominio `saludaweb.com`

2. **Subir archivos del proyecto**
   - Sube todos los archivos del proyecto EXCEPTO:
     - `/vendor/`
     - `composer.lock`
     - `.env` (lo crearás después)
   - Usa el administrador de archivos de Hostinger o FTP

3. **Conectarse por SSH (opcional, si está disponible)**
   - Esto facilitará la ejecución de comandos siguientes

4. **Configurar el archivo .env**
   - Crea o edita el archivo `.env` con la configuración correcta:
     - Base de datos
     - Correo
     - URL de la aplicación
     - Claves de API

5. **Instalar dependencias**
   ```bash
   cd public_html
   composer install --no-dev --optimize-autoloader
   ```

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

Si estás teniendo problemas con el archivo `composer.lock`, sigue estos pasos:

1. **Accede a tu cuenta Hostinger por SSH**

2. **Navega al directorio donde quieres instalar la aplicación**
   ```bash
   cd public_html
   ```

3. **Inicializa un repositorio Git (si no existe)**
   ```bash
   git init
   ```

4. **Agrega el repositorio remoto**
   ```bash
   git remote add origin https://github.com/DevSaluda/SaludaCRMERP.git
   ```

5. **Crea un archivo .gitignore temporal**
   ```bash
   echo "composer.lock" > .gitignore
   ```

6. **Haz pull desde el repositorio**
   ```bash
   git pull origin master
   ```

7. **Sigue los pasos 4 a 9 de la Opción 1**

## Solución de problemas comunes

### Error con composer.lock
Si recibes el error "The following untracked working tree files would be overwritten by merge: composer.lock":

```bash
rm composer.lock
git pull origin master
```

### Error al instalar dependencias
Si composer falla al instalar dependencias:

```bash
composer install --no-dev --ignore-platform-reqs
```

### Error con las migraciones
Si las migraciones fallan, verifica la conexión a la base de datos en el archivo `.env` 