Farbesoft CheckRole
===================
[![Laravel 5.5](https://img.shields.io/badge/Laravel-5.3-orange.svg?style=flat-square)](http://laravel.com)
[![Source](http://img.shields.io/badge/source-farbesofts/checkrole-blue.svg?style=flat-square)](https://github.com/farbesofts/checkrole)
[![License](http://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](https://tldrlegal.com/license/mit-license)

checkRole is a simple and lightweight library that provides developers with a useful tool when creating login restrictions in personalized schedules by users to a specific role in the system.

- Every user has a single schedule defined.

Documentation
-------------
(Comming Soon)

Quick Installation
------------------
Begin by installing the package through Composer. The best way to do this is through your terminal via Composer itself:

```
composer require farbesofts/checkrole
```

Configuration
-------------------------------

To publish the config file and NotAccess view, run the following:

```
php artisan vendor:publish
```
Choose the option where the library is located, in my case:
```
[2] Provider: Farbesofts\Checkrole\CheckroleServiceProvider
```

### Service Provider
- copy the following in config.app (array Providers)

```php
Farbesofts\Checkrole\CheckroleServiceProvider::class,
```

### Middleware kernel.php
- copy on App\Http\Kernel.php -> (array $routeMiddleware):
```php
'CheckRole' => \Farbesofts\Checkrole\CheckroleServiceProvider::class,
```

### Migrations
- Migrate the models
```
php artisan make:auth
php artisan migrate
```
If you are using a library of roles and permissions, just migrate:
```
2019_03_16_160254_create_timetables_table
```
### Header on User Model
- Copy on App\User.php Model:
```php
use Farbesofts\Checkrole\Models\Role;
use Farbesofts\Checkrole\Models\Timetable;
use Illuminate\Support\Facades\Auth;
```
### Methods on User Model
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








