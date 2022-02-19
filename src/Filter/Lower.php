<?php

namespace Takemo101\LaravelSimpleTempla\Filter;

use Takemo101\SimpleTempla\Filter\FilterProcessInterface;
use Illuminate\Support\Str;

final class Lower implements FilterProcessInterface
{
    /**
     * execute filter process
     *
     * @param string $value
     * @return string
     */
    public function execute(string $value): string
    {
        return Str::lower($value);
    }
}
