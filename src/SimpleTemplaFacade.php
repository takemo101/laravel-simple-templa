<?php

namespace Takemo101\LaravelSimpleTempla;

use Takemo101\SimpleTempla\Template\Template;
use Illuminate\Support\Facades\Facade;

/**
 * @method static Template template(string $text)
 * @method static string parse(string $text, mixed[] $data)
 * @method static SimpleTempla addPresetFilter(Filter $filter)
 *
 * @see \Takemo101\LaravelSimpleTempla\SimpleTempla
 */
class SimpleTemplaFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return SimpleTempla::class;
    }
}
