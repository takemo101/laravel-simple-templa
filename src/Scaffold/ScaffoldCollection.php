<?php

namespace Takemo101\LaravelSimpleTempla\Scaffold;

use Illuminate\Contracts\Foundation\Application;

/**
 * scaffold collection class
 */
final class ScaffoldCollection
{

    /**
     * @var string[]
     */
    private array $scaffolds;

    /**
     * constructor
     *
     * @param Application $app
     * @param string ...$scaffolds
     */
    private function __construct(
        private Application $app,
        string ...$scaffolds,
    ) {
        $this->scaffolds = $scaffolds;
    }

    /**
     * make scaffold by name
     *
     * @param string $name
     * @return Scaffold|null
     */
    public function makeByName(string $name): ?Scaffold
    {
        if (!array_key_exists($name, $this->scaffolds)) {
            return null;
        }

        $class = $this->scaffolds[$name];

        if (!class_exists($class)) {
            return null;
        }

        $scaffold = $this->app->make($class);
        return $scaffold instanceof Scaffold ? $scaffold : null;
    }

    /**
     * add scaffold
     *
     * @param string $name
     * @param Scaffold $scaffold
     * @return self
     */
    public function add(string $name, Scaffold $scaffold): self
    {
        $this->scaffolds[$name] = $scaffold;

        return $this;
    }

    /**
     * factory
     *
     * @param Application $app
     * @param array $scaffolds
     * @return self
     */
    public static function fromArray(Application $app, array $scaffolds): self
    {
        return new self($app, ...$scaffolds);
    }
}
