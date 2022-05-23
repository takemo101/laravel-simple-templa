# The Simple Templa For Laravel

[![Testing](https://github.com/takemo101/laravel-simple-templa/actions/workflows/testing.yml/badge.svg)](https://github.com/takemo101/laravel-simple-templa/actions/workflows/testing.yml)
[![PHPStan](https://github.com/takemo101/laravel-simple-templa/actions/workflows/phpstan.yml/badge.svg)](https://github.com/takemo101/laravel-simple-templa/actions/workflows/phpstan.yml)
[![Validate Composer](https://github.com/takemo101/laravel-simple-templa/actions/workflows/composer.yml/badge.svg)](https://github.com/takemo101/laravel-simple-templa/actions/workflows/composer.yml)

This package is a wrap of Simple Templa for Laravel.  
A Scaffold function using Simple Templa has also been added.

## Installation
Execute the following composer command.
```
composer require takemo101/laravel-simple-templa
```

## Publish the config
Publish the config with the following artisan command.  
You can set filters and scaffolds from the config.
```
php artisan vendor:publish --tag="simple-templa"
```

## How to use
Please use as follows

### Simple Templa Facade
You can use the template language by using the Facade class.
```php
// Get Template object
$template = \SimpleTempla::template('{{ data.a }} {{ data.b }}');

// Run parse
echo $template->parse([
    'data' => [
        'a' => 'hello',
        'b' => 'world',
    ],
]);
// hello world

// Run parse immediately
echo \SimpleTempla::parse(
    '{{ data.a }} {{ data.b }}'),
    [
        'data' => [
            'a' => 'hello',
            'b' => 'world',
        ],
    ]
);
// hello world
```

### Scaffold
Run the Artisan command below to generate the Scaffold class.
```
php artisan make:scaff ClassName
```
Please set the input rule and output path in the generated Scaffold class.
```php
<?php
// ./app/Scaffolds/DemoScaffold.php

namespace App\Scaffolds;

use Takemo101\LaravelSimpleTempla\Scaffold\Scaffold;

// Must inherit from Scaffold class
class DemoScaffold extends Scaffold
{
    /**
     * Constructor injection is possible
     */
    public function __construct()
    {
        //
    }

    /**
     * get need command option validation rules
     *
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
        ];
    }

    /**
     * get inout path sets
     *
     * @param mixed[] $data
     * @return array<string,string|string[]>
     */
    public function inoutPaths(array $data): array
    {
        // You can create a class file using the template language from the file
        return [
            resource_path("stub/Entity.stub") 
            => app_path("Entity/{{ name|ucfirst }}Entity.php"),
        ];
    }
}
```
Create a stub file as the output source.  
```php
<?php
// ./resources/stub/Entity.stub

namespace Stub\Entity\Demo{{ name|ucfirst }};

class Demo{{ name|ucfirst }}Entity
{
    /**
     * @var string
     */
    private string $name = '{{ key|lower }}';
}
```
Set the created Scaffold class in the config.
```php
<?php
// ./config/simple-sample.php

return [
    ...
    'scaffolds' => [
        'demo' => App\Scaffolds\DemoScaffold::class,
    ],
]
```
After setting the Scaffold class, run Artisan to create the file.
```
php artisan simple-templa:exec demo
```
## Filter for Laravel
In the template language, you can use Filter using Laravel's Str class.
| filter | str method |
| - | - |
| camel | Str::camel |
| headline | Str::headline |
| kebab | Str::kebab |
| lower | Str::lower |
| markdown | Str::markdown |
| plural | Str::plural |
| pluralStudly | Str::pluralStudly |
| reverse | Str::reverse |
| singular | Str::singular |
| slug | Str::slug |
| snake | Str::snake |
| studly | Str::studly |
| title | Str::title |
| ucfirst | Str::ucfirst |
| upper | Str::upper |
