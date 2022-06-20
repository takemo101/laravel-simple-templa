<?php

namespace Takemo101\LaravelSimpleTempla\Scaffold;

/**
 * simple scaffold
 */
abstract class SimpleScaffold extends Scaffold
{
    /**
     * @var mixed[]
     */
    private array $extend = [];

    protected function addExtend(string $key, mixed $value): static
    {
        $this->extend[$key] = $value;

        return $this;
    }

    /**
     * get extended data
     *
     * @param mixed[] $data
     * @return mixed[]
     */
    public function extend(array $data): array
    {
        return array_merge(
            $this->extend,
            $data,
        );
    }
}
