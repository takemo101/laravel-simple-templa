<?php

namespace Takemo101\LaravelSimpleTempla\Command;

use Illuminate\Console\Concerns\CreatesMatchingTest;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

class MakeScaffoldCommand extends GeneratorCommand
{
    use CreatesMatchingTest;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:scaff';

    /**
     * The name of the console command.
     *
     * This name is used to identify the command during lazy loading.
     *
     * @var string|null
     */
    protected static $defaultName = 'make:scaff';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new scaffold class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Scaffold';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/../../stub/Scaffold.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Scaffolds';
    }

    /**
     * is custom namespace
     *
     * @return boolean
     */
    protected function isCustomNamespace(): bool
    {
        return Str::contains($this->getNameInput(), '/');
    }
}
