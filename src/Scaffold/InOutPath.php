<?php

namespace Takemo101\LaravelSimpleTempla\Scaffold;

/**
 * input and output file path DTO class
 */
final class InOutPath
{
    /**
     * constructor
     *
     * @param string $inputPath
     * @param string $outputPath
     */
    public function __construct(
        private string $inputPath,
        private string $outputPath,
    ) {
        //
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
     * @return string
     */
    public function getOutputPath(): string
    {
        return $this->outputPath;
    }
}
