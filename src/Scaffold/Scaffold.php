<?php

namespace Takemo101\LaravelSimpleTempla\Scaffold;

use Illuminate\Support\Arr;

/**
 * scaffold super class
 */
abstract class Scaffold
{
    /**
     * get need command option validation rules
     *
     * @return string[]
     */
    public function rules(): array
    {
        return [];
    }

    /**
     * get inout path sets
     *
     * @return string[]
     */
    public function inoutPaths(): array
    {
        return [];
    }

    /**
     * get option by key
     *
     * @param string $key
     * @return string|null
     */
    protected function option(string $key): ?string
    {
        return Arr::get($this->options, $key);
    }

    /**
     * get options
     *
     * @param string $key
     * @return mixed[]
     */
    protected function options(): array
    {
        return $this->options;
    }
}
