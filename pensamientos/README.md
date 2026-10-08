# Pensamientos

Aplicación Laravel 13 + PHP 8.4 + SQLite para compartir pensamientos.

## Esta versión

- Corregidas las vistas de búsqueda, publicación y perfil.
- Corregida la impresión de `@username` en Blade.
- Corregidos los nombres de ruta del perfil.
- SQLite incluida con usuarios y publicaciones de demostración.
- Los estilos y JavaScript se sirven desde `public/css/app.css` y `public/js/app.js`, por lo que **no necesitas ejecutar `npm run dev`** para usar esta copia.

## Primer arranque

1. Instala dependencias PHP si la carpeta `vendor` no está presente:

```powershell
composer install
```

2. Verifica que `.env` use SQLite y sesiones por archivo.

3. Inicia Laravel:

```powershell
php artisan serve
```

4. Abre `http://127.0.0.1:8000`.

## Usuario de demostración

- Usuario: `admin`
- Correo: `admin@sistema.com`
- Contraseña: `password`

También existen 10 usuarios de demostración; todos usan la contraseña `password`.

## Si quieres regenerar la base de datos

```powershell
php artisan migrate:fresh --seed
```

## Si modificas CSS o JavaScript

Esta versión no depende de Vite para ejecutarse. Si cambias `resources/css/app.css` o `resources/js/app.js`, copia esos archivos a:

- `public/css/app.css`
- `public/js/app.js`
