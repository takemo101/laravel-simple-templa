<?php

namespace Takemo101\LaravelSimpleTempla\Scaffold;

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
    abstract public function rules(): array;

    /**
     * get inout path sets
     *
     * @param mixed[] $data
     * @return array<string,string|string[]>
     */
    abstract public function inoutPaths(array $data): array;
}
