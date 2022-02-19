<?php

namespace Test;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Takemo101\LaravelSimpleTempla\Scaffold\{
    ScaffoldProcess,
    PathIterator,
};

class ScaffoldTest extends TestCase
{
    /**
     * @var string
     */
    private string $baseDirectory = '';

    protected function setUp(): void
    {
        parent::setUp();

        $this->baseDirectory = dirname(__DIR__, 1);
    }

    /**
     * @test
     */
    public function executeScaffoldProcess__OK(): void
    {
        /**
         * @var ScaffoldProcess
         */
        $process = $this->app[ScaffoldProcess::class];

        /**
         * @var Filesystem
         */
        $filesystem = $this->app[Filesystem::class];

        $process->execute(
            PathIterator::fromStrings([
                "{$this->baseDirectory}/stub/Entity.stub" => "{$this->baseDirectory}/app/Demo{{ name|ucfirst }}/{{ name|ucfirst }}Entity.php",
            ]),
            [
                'name' => 'test',
                'key' => 'key',
            ],
        );

        $path = "{$this->baseDirectory}/app/DemoTest/TestEntity.php";

        $this->assertTrue(
            $filesystem->exists($path),
        );

        $filesystem->delete($path);
    }


    /**
     * @test
     */
    public function executeScaffoldProcess__NG(): void
    {
        $this->expectException(FileNotFoundException::class);

        /**
         * @var ScaffoldProcess
         */
        $process = $this->app[ScaffoldProcess::class];

        $process->execute(
            PathIterator::fromStrings([
                "{$this->baseDirectory}/stub/Antity.stub" => "{$this->baseDirectory}/app/Demo{{ name|ucfirst }}/{{ name|ucfirst }}Entity.php",
            ]),
            [
                'name' => 'test',
                'key' => 'key',
            ],
        );
    }
}
