<?php

namespace Test;

use Takemo101\LaravelSimpleTempla\{
    ServiceProvider,
    SimpleTemplaFacade,
};
use Takemo101\LaravelSimpleTempla\Scaffold\DemoScaffold;
use Takemo101\LaravelSimpleTempla\Filter\DemoFilter;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            ServiceProvider::class,
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'SimpleTempla' => SimpleTemplaFacade::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set(
            'simple-templa',
            [
                'filters' => [
                    'demo' => DemoFilter::class,
                ],
                'scaffolds' => [
                    'demo' => DemoScaffold::class,
                ],
            ]
        );
    }
}
