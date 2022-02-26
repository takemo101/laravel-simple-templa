<?php

namespace Takemo101\LaravelSimpleTempla\Scaffold;

/**
 * input and output file path DTO class
 */
final class InOutPath
{
    /**
     * @var string[]
     */
    private array $outputPath;

    /**
     * constructor
     *
     * @param string $inputPath
     * @param string|string[] $outputPath
     */
    public function __construct(
        private string $inputPath,
        string|array $outputPath,
    ) {
        $this->outputPath = is_string($outputPath) ? [$outputPath] : $outputPath;
    }

    /**
     * get input path
     *
     * @return string
     */
    public function getInputPath(): string
    {
        return $this->inputPath;
    }

    /**
     * get output path
     *
     * @return string[]
     */
    public function getOutputPath(): array
    {
        return $this->outputPath;
    }
}
