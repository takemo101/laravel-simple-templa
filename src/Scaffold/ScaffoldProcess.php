<?php

namespace Takemo101\LaravelSimpleTempla\Scaffold;

use Takemo101\LaravelSimpleTempla\SimpleTempla;
use Illuminate\Filesystem\Filesystem;

/**
 * scaffold process class
 */
final class ScaffoldProcess
{
    public function __construct(
        private Filesystem $filesystem,
        private SimpleTempla $templa,
    ) {
        //
    }

    /**
     * execute scaffold process
     *
     * @param PathIterator $iterator
     * @param mixed[] $data
     * @return void
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function execute(PathIterator $iterator, array $data): void
    {
        foreach ($iterator->iterator() as $path) {
            $this->createFile($path, $data);
        }
    }

    /**
     * create scaffold file
     *
     * @param InOutPath $path
     * @param array $data
     * @return void
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    private function createFile(InOutPath $path, array $data): void
    {
        $outputPath = $this->templa->parse(
            $path->getOutputPath(),
            $data,
        );
        $inputPath = $path->getInputPath();

        $inputText = $this->filesystem->get($inputPath);
        $outputText = $this->templa->parse($inputText, $data);

        $outputDirectory = $this->filesystem->dirname($outputPath);
        $this->filesystem->ensureDirectoryExists($outputDirectory, 0755);

        $this->filesystem->put($outputPath, $outputText);
    }
}
