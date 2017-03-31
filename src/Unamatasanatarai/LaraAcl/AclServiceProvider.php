<?php

namespace Unamatasanatarai\LaraAcl;

use Blade;
use Illuminate\Support\ServiceProvider;

class AclServiceProvider extends ServiceProvider
{

    protected $defer = false;

    /**
     * Bootstrap the application events.
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/migrations/');

        $this->registerBladeExtensions();
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        //$this->app->bind('spy', 'Unamatasanatarai\LaraSpy\SpySupervisor');
        //
        //$this->app->bind('Unamatasanatarai\LaraSpy\Handler\HandlerInterface',
        //    'Unamatasanatarai\LaraSpy\Handler\EloquentHandler');
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

    private function registerBladeExtensions()
    {
        Blade::directive('permitted', function ($expression) {
            $expression = var_export(explode(',', $expression), 1);
            return "<?php if (Auth::check() && Auth::user()->hasPermission({$expression})): ?>";
        });
        Blade::directive('endpermitted', function () {
            return "<?php endif; ?>";
        });
        Blade::directive('acting', function ($expression) {
            $expression = var_export(explode(',', $expression), 1);
            return "<?php if (Auth::check() && Auth::user()->hasRole({$expression})): ?>";
        });
        Blade::directive('endacting', function () {
            return "<?php endif; ?>";
        });
    }
}
