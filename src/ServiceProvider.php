<?php

namespace SwaggerUILumen;

use SwaggerUILumen\Console\PublishCommand;
use Illuminate\Support\ServiceProvider as BaseProvider;

class ServiceProvider extends BaseProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $viewPath = __DIR__.'/../resources/views';
        $this->loadViewsFrom($viewPath, 'swagger-ui-lumen');

        $this->app->group(['namespace' => 'SwaggerUILumen'], function ($app) {
            require __DIR__.'/routes.php';
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $configPath = __DIR__.'/../config/swagger-ui-lumen.php';
        $this->mergeConfigFrom($configPath, 'swagger-ui-lumen');

        $this->app['command.swagger-ui-lumen.publish'] = $this->app->share(
            function () {
                return new PublishCommand();
            }
        );

        $this->app['command.swagger-ui-lumen.publish-config'] = $this->app->share(
            function () {
                return new PublishConfigCommand();
            }
        );

        $this->app['command.swagger-ui-lumen.publish-views'] = $this->app->share(
            function () {
                return new PublishViewsCommand();
            }
        );

        $this->app['command.swagger-ui-lumen.publish-assets'] = $this->app->share(
            function () {
                return new PublishAssetsCommand();
            }
        );

        $this->commands(
            'command.swagger-ui-lumen.publish',
            'command.swagger-ui-lumen.publish-config',
            'command.swagger-ui-lumen.publish-views',
            'command.swagger-ui-lumen.publish-assets'
        );
    }
}
