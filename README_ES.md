Farbesoft CheckRole
===================
[![Laravel 5.5](https://img.shields.io/badge/Laravel-5.3-orange.svg?style=flat-square)](http://laravel.com)
[![Source](http://img.shields.io/badge/source-farbesofts/checkrole-blue.svg?style=flat-square)](https://github.com/farbesofts/checkrole)
[![License](http://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](https://tldrlegal.com/license/mit-license)

CheckRole es una librería liviana que proporciona a los desarrolladores una herramienta útil al crear restricciones de inicio de sesión con horarios personalizados a los usuarios con un rol específico en el sistema.

- Cada Usuario tiene un Horario Establecido.

Documentación
-------------
(Muy Pronto)

Guía de Instalación
------------------
Comience por instalar el paquete a través de Composer. La mejor manera de hacerlo es a través de su terminal:
```
composer require farbesofts/checkrole
```

Configuración
-------------------------------

Para publicar el Archivo config/checkrole.php y la vista NotAccess,Ejecuta lo siguiente:

```
php artisan vendor:publish
```
Escoja la opción donde se encuentre la libreria, en mi caso:

```
[2] Provider: Farbesofts\Checkrole\CheckroleServiceProvider
```

### Service Provider
- Copiar en config.app (Arreglo Providers) lo siguiente:

```php
Farbesofts\Checkrole\CheckroleServiceProvider::class,
```

### Middleware kernel.php
- Copiar en App\Http\Kernel.php -> (array $routeMiddleware) lo siguiente:
```php
'CheckRole' => \Farbesofts\Checkrole\CheckroleServiceProvider::class,
```

- Migrando los Modelos
### Migrations
```
php artisan make:auth
php artisan migrate
```
Si estás usando una librería de Roles y Permisos solo Migra lo necesario,
en mi caso: timetables (Horarios)
```
2019_03_16_160254_create_timetables_table
```

### Cabecera (uses) en el Modelo User
- Copiar App\User.php Model:

```php
use Farbesofts\Checkrole\Models\Role;
use Farbesofts\Checkrole\Models\Timetable;
use Illuminate\Support\Facades\Auth;
```

### Métodos necesarios en el Modelo User
```php
    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    public function hasRole($role)
    {
        if ($this->roles()->where('name', $role)->first()) {
            return  true;
        }
        return false;
    }

    public function Timetable(){
        return $this->hasOne(Timetable::class);
    }

    public function getTimetable(){
        return $this->Timetable()->where('user_id',Auth::user()->id)->first();
    }
```

### Ruta con el Middleware Checkrole
- Copiar en routes\web.php: example (Role:admin)
```php
Route::get('/notaccess', function () {
    return view('notaccess');
});
Route::group(['middleware' => 'CheckRole:admin'], function() {
    Route::get('/home', 'HomeController@index')->name('home');
});
```