<?php

namespace RyanLHolt\Infused;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use RyanLHolt\Infused\Http\Middleware\CheckValidInfusionsoftToken;

class InfusedServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->handlePackageAssets();

        if ($this->app->runningInConsole()) {
            $this->publishPackageAssets();
        }

        app('router')->aliasMiddleware(
            'infuse',
            CheckValidInfusionsoftToken::class
        );
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'infused');

        // Register the main class to use with the facade
        $this->app->singleton('infused', function ($app) {
            return new Infused($app);
        });
    }

    private function publishPackageAssets()
    {
        $this->publishes([
            __DIR__ . '/../config/config.php' => config_path('infused.php'),
        ], 'config');

        $this->publishes([
            __DIR__ . '/../database/migrations/create_infusionsoft_tokens_table.php.stub' => database_path(
                'migrations/' . date('Y_m_d_His', time()) . '_create_infusionsoft_tokens_table.php'
            ),
        ], 'migrations');

        // Publishing the views.
        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/infused'),
        ], 'views');

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/infused'),
        ], 'assets');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/infused'),
        ], 'lang');*/

        // Registering package commands.
        // $this->commands([]);
    }

    protected function handlePackageAssets()
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'infused');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'infused');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->registerRoutes();
    }

    protected function registerRoutes()
    {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        });
    }

    /**
     * @return array
     */
    protected function routeConfiguration(): array
    {
        return [
            'prefix' => config('infused.prefix'),
            'middleware' => config('infused.middleware'),
        ];
    }
}
