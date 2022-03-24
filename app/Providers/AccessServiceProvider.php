<?php

namespace App\Providers;

use App\Services\Access\Access;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

/**
 * Class AccessServiceProvider.
 */
class AccessServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Package boot method.
     */
    public function boot()
    {
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerAccess();
        $this->registerFacade();
    }

    /**
     * Register the application bindings.
     *
     * @return void
     */
    private function registerAccess()
    {
        $this->app->bind('access', function ($app) {
            return new Access($app);
        });
    }

    /**
     * Register the vault facade without the user having to add it to the app.php file.
     *
     * @return void
     */
    public function registerFacade()
    {
        $this->app->booting(function () {
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('Access', \App\Services\Access\Facades\Access::class);
        });
    }
}