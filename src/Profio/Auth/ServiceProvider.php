<?php

namespace Profio\Auth;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    protected $packageName = 'profio/auth';

    protected $viewDirectory = '/../../../views';

    protected $migrationDirectory = '/../../../migrations';

    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . $this->viewDirectory, $this->packageName);

        $this->publishes([
            __DIR__ . $this->viewDirectory => base_path('resources/views/vendor/' . $this->packageName),
        ]);

        $this->publishes([
            __DIR__ . $this->migrationDirectory => database_path('migrations'),
        ], 'migrations');

        $this->mergeConfigFrom(
            __DIR__ . '/../../../config.php', 'profio.auth'
        );

        $this->publishes([
            __DIR__ . '/../../../config.php' => config_path('profio/auth.php'),
        ]);

        if (!$this->app->routesAreCached()) {
            require __DIR__ . '/routes.php';
        }
    }

    public function register()
    {

    }
}
