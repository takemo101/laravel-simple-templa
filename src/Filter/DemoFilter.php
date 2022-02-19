<?php

namespace Takemo101\LaravelSimpleTempla\Filter;

use Illuminate\Filesystem\Filesystem;
use Takemo101\SimpleTempla\Filter\FilterProcessInterface;

final class DemoFilter implements FilterProcessInterface
{
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
