<?php

namespace Takemo101\LaravelSimpleTempla\Scaffold;

use Takemo101\LaravelSimpleTempla\SimpleTempla;

/**
 * demo scaffold
 */
final class DemoScaffold extends Scaffold
{
    /**
     * @var string
     */
    private string $baseDirectory;

    /**
     * constructor
     */
    public function __construct()
    {
        $this->baseDirectory = dirname(__DIR__, 2);
    }

    /**
     * get need command option validation rules
     *
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'key' => 'required',
        ];
    }

    /**
     * get inout path sets
     *
     * @return string[]
     */
    public function inoutPaths(): array
    {
        return [
            "{$this->baseDirectory}/stub/Entity.stub" => "{$this->baseDirectory}/app/Demo{{ name|ucfirst }}/{{ name|ucfirst }}Entity.php",
            "{$this->baseDirectory}/stub/Repository.stub" => "{$this->baseDirectory}/app/Demo{{ name|ucfirst }}/{{ name|ucfirst }}Repository.php",
        ];
    }
}
