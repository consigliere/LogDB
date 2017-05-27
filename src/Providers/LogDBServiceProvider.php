<?php

namespace App\Components\LogDB\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;

class LogDBServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();

        $this->loadMigrationsFrom(__DIR__.'/../../Database/Migrations');

        $dispatcher = $this->app->make('events');
        $dispatcher->subscribe('App\Components\LogDB\Listeners\LogDBEventListener');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register('Jenssegers\Agent\AgentServiceProvider');

        // Load the Facade aliases
        $loader = AliasLoader::getInstance();
        $loader->alias('Agent', \Jenssegers\Agent\Facades\Agent::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__.'/../../Config/config.php' => config_path('logdb.php'),
        ], 'config-logdb');
        $this->mergeConfigFrom(
            __DIR__.'/../../Config/config.php', 'logdb'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = base_path('resources/views/components/logdb');

        $sourcePath = __DIR__.'/../../Resources/views';

        $this->publishes([
            $sourcePath => $viewPath
        ]);

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/components/logdb';
        }, \Config::get('view.paths')), [$sourcePath]), 'logdb');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = base_path('resources/lang/components/logdb');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'logdb');
        } else {
            $this->loadTranslationsFrom(__DIR__ .'/../../Resources/lang', 'logdb');
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
