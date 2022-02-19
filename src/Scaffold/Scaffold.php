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
}
