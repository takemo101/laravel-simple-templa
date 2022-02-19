<?php

namespace Takemo101\LaravelSimpleTempla\Filter;

use Illuminate\Contracts\Filesystem\Filesystem;
use Takemo101\SimpleTempla\Filter\FilterProcessInterface;

final class DemoFilter implements FilterProcessInterface
{
    public function __construct(
        private Filesystem $filesystem,
    ) {
        //
    }

    /**
     * execute filter process
     *
     * @param string $value
     * @return string
     */
    public function execute(string $value): string
    {
        return '===' . $value . '===';
    }
}
