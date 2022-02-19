<?php

namespace Takemo101\LaravelSimpleTempla;

use Illuminate\Contracts\Foundation\Application;
use Takemo101\SimpleTempla\Environment\{
    DefaultEnvironmentCreator,
    Environment,
};
use Takemo101\SimpleTempla\Filter\{
    FilterName,
    Filter,
    FilterProcessInterface,
};
use Takemo101\LaravelSimpleTempla\Filter\{
    Camel,
    Headline,
    Kebab,
    Lower,
    Markdown,
    Plural,
    Reverse,
    Singular,
    Slug,
    Snake,
    Studly,
    Title,
    UCFirst,
    Upper,
};

/**
 * simple temple environment factory for laravel class
 */
final class EnvironmentFactory
{
    public function __construct(
        private Application $app,
    ) {
        //
    }

    /**
     * factory
     *
     * @param string[] $filters
     * @return Environment
     */
    public function factory(array $filters = []): Environment
    {
        $environment = DefaultEnvironmentCreator::createSimple();

        // default filters
        foreach ([
            'camel' => Camel::class,
            'headline' => Headline::class,
            'kebab' => Kebab::class,
            'lower' => Lower::class,
            'markdown' => Markdown::class,
            'plural' => Plural::class,
            'reverse' => Reverse::class,
            'singular' => Singular::class,
            'slug' => Slug::class,
            'snake' => Snake::class,
            'studly' => Studly::class,
            'title' => Title::class,
            'ucfirst' => UCFirst::class,
            'upper' => Upper::class,
        ] as $name => $class) {
            $environment->addPresetFilter(new Filter(
                new FilterName($name),
                new $class,
            ));
        }

        // additional filters
        foreach ($filters as $name => $class) {
            if (class_exists($class)) {
                $filterProcess = $this->app->make($class);
                if ($filterProcess instanceof FilterProcessInterface) {
                    $environment->addPresetFilter(new Filter(
                        new FilterName($name),
                        $filterProcess,
                    ));
                }
            }
        }

        return $environment;
    }
}
