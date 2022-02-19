<?php

namespace Takemo101\LaravelSimpleTempla\Scaffold;

/**
 * path iterator
 */
final class PathIterator
{
    /**
     * @var InOutPath[]
     */
    private array $iterator;

    /**
     * constructor
     *
     * @param InOutPath ...$iterator
     */
    public function __construct(InOutPath ...$iterator)
    {
        $this->iterator = $iterator;
    }

    /**
     * get iterator
     *
     * @return InOutPath[]
     */
    public function iterator(): array
    {
        return $this->iterator;
    }

    /**
     * factory
     *
     * @param InOutPath[] $iterator
     * @return self
     */
    public static function fromArray(array $iterator): self
    {
        return new self(...$iterator);
    }

    /**
     * factory
     *
     * @param string[] $paths
     * @return self
     */
    public static function fromStrings(array $paths): self
    {
        /**
         * @var InOutPath[]
         */
        $iterator = [];

        foreach ($paths as $inputPath => $outputPath) {
            $iterator[] = new InOutPath(
                $inputPath,
                $outputPath,
            );
        }

        return self::fromArray($iterator);
    }
}
