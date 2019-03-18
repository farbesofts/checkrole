<?php

namespace Farbesofts\Checkrole;

use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class CheckroleServiceProvider extends ServiceProvider
{

    protected $defer = false;

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/checkrole.php' => config_path('checkrole.php'),
            __DIR__.'/view/notaccess.blade.php' => resource_path('views/notaccess.blade.php')
        ]);

        if (version_compare(Application::VERSION, '5.3.0', '<')) {
            $this->publishes([
                __DIR__ . '/../migrations' => $this->app->databasePath() . '/migrations',
            ], 'migrations');
        } else {
            if (config('checkrole.run-migrations', true)) {
                $this->loadMigrationsFrom(__DIR__ . '/../migrations');
            }
        }

    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/checkrole.php', 'checkrole',
            __DIR__.'/view/notaccess.blade.php','notaccess'
        );
    }

    public function provides()
    {
        return ['checkrole'];
    }
}
