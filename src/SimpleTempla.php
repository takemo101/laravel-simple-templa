<?php

namespace Takemo101\LaravelSimpleTempla;

use Takemo101\SimpleTempla\Template\Template;
use Takemo101\SimpleTempla\Environment\Environment;
use Takemo101\SimpleTempla\Filter\Filter;

/**
 * simple template package wrapper class
 */
final class SimpleTempla
{
    /**
     * constructor
     *
     * @param Environment $environment
     */
    public function __construct(
        private Environment $environment,
    ) {
        //
    }

    /**
     * create template by text string
     *
     * @param string $text
     * @return Template
     */
    public function template(string $text): Template
    {
        return $this->environment->createTemplate($text);
    }

    /**
     * parse template by text string
     *
     * @param string $text
     * @param mixed[] $data
     * @return string
     */
    public function parse(string $text, array $data): string
    {
        return $this->template($text)->parse($data);
    }

    /**
     * add preset filter
     *
     * @param Filter $filter
     * @return self
     */
    public function addPresetFilter(Filter $filter): self
    {
        $this->environment->addPresetFilter($filter);

        return $this;
    }
}
