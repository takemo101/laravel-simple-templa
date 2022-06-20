<?php

namespace Test;

use Takemo101\LaravelSimpleTempla\Scaffold\SimpleScaffold;

/**
 * demo scaffold
 */
final class DemoScaffold extends SimpleScaffold
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
        $this->baseDirectory = dirname(__DIR__, 1);
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
     * @param mixed[] $data
     * @return array<string,string|string[]>
     */
    public function inoutPaths(array $data): array
    {
        $this->addExtend('extend', 'extend');
        $this->addExtend('name', 'death');

        return [
            "{$this->baseDirectory}/stub/Entity.stub" => [
                "{$this->baseDirectory}/app/Demo{{ name|ucfirst }}/{{ name|ucfirst }}Entity.php",
                "{$this->baseDirectory}/app/Test{{ name|ucfirst }}/{{ name|ucfirst }}Entity.php",
            ],
            "{$this->baseDirectory}/stub/Repository.stub" => "{$this->baseDirectory}/app/Demo{{ name|ucfirst }}/{{ name|ucfirst }}Repository.php",
        ];
    }
}
