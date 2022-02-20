<?php

namespace Takemo101\LaravelSimpleTempla;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Illuminate\Filesystem\Filesystem;
use Takemo101\LaravelSimpleTempla\Command\MakeScaffoldCommand;
use Takemo101\LaravelSimpleTempla\Scaffold\{
    ScaffoldCollection,
    ScaffoldProcess,
};

/**
 * this package service provider class
 */
class ServiceProvider extends BaseServiceProvider
{
    /**
     * @var string
     */
    protected $config = 'simple-templa';

    /**
     * @var string
     */
    protected $baseDirectory;

    public function __construct($app)
    {
        parent::__construct($app);

        $this->baseDirectory = dirname(__DIR__, 1);
    }

    public function register(): void
    {
        $this->mergeConfigFrom("{$this->baseDirectory}/config/config.php", $this->config);

        $this->app->singleton(EnvironmentFactory::class, function ($app) {
            return new EnvironmentFactory($app);
        });
        $this->app->singleton(SimpleTempla::class, function ($app) {
            /**
             * @var EnvironmentFactory
             */
            $factory = $app[EnvironmentFactory::class];

            return new SimpleTempla(
                $factory->factory(
                    $app['config']->get("{$this->config}.filters", []),
                ),
            );
        });
        $this->app->singleton(ScaffoldCollection::class, function ($app) {
            return ScaffoldCollection::fromArray(
                $app,
                $app['config']->get("{$this->config}.scaffolds", []),
            );
        });
        $this->app->bind(ScaffoldProcess::class, function ($app) {
            return new ScaffoldProcess(
                $app[Filesystem::class],
                $app[SimpleTempla::class],
            );
        });
    }

    public function boot(): void
    {
        $this->bootPublishes();
        $this->bootConsoleCommands();
    }

    /**
     * boot publish files
     *
     * @return void
     */
    protected function bootPublishes(): void
    {
        $this->publishes([
            "{$this->baseDirectory}/config/config.php" => $this->app->configPath("{$this->config}.php"),
        ], 'simple-templa');
    }

    /**
     * boot commands
     *
     * @return void
     */
    protected function bootConsoleCommands(): void
    {
        if (!$this->app->runningInConsole()) {
            return;
        }

        $this->commands([
            MakeScaffoldCommand::class,
        ]);
    }
}
