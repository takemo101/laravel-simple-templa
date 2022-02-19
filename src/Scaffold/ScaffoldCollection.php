<?php

namespace Takemo101\LaravelSimpleTempla\Scaffold;

use Illuminate\Contracts\Foundation\Application;
use InvalidArgumentException;

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
        foreach ($scaffolds as $name => $class) {
            $this->add((string)$name, $class);
        }
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

        $scaffold = $this->app->make($class);
        return $scaffold instanceof Scaffold ? $scaffold : null;
    }

    /**
     * add scaffold
     *
     * @param string $name
     * @param string $class
     * @return self
     * @throws InvalidArgumentException
     */
    public function add(string $name, string $class): self
    {
        if (!class_exists($class)) {
            throw new InvalidArgumentException("class does not exist: [{$class}]");
        }

        $this->scaffolds[$name] = $class;

        return $this;
    }

    /**
     * factory
     *
     * @param Application $app
     * @param string[] $scaffolds
     * @return self
     */
    public static function fromArray(Application $app, array $scaffolds): self
    {
        return new self($app, ...$scaffolds);
    }
}
