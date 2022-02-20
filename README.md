# The Simple Templa For Laravel
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
```
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
Set the created Scaffold class in the config.
```
<?php
// ./config/simple-sample.php

return [
    ...
    'scaffolds' => [
        'demo' => App\Scaffolds\DemoScaffold::class,
    ],
]
```
```
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
     * @return string[]
     */
    public function inoutPaths(): array
    {
        // You can create a class file using the template language from the file
        return [
            resource_path("stub/Entity.stub") 
            => app_path("Entity/{{ name|ucfirst }}Entity.php"),
        ];
    }
}
```
```
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
After setting the Scaffold class, run Artisan to create the file.
```
$ php artisan make:scaff demo
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
| reverse | Str::reverse |
| singular | Str::singular |
| slug | Str::slug |
| snake | Str::snake |
| studly | Str::studly |
| title | Str::title |
| ucfirst | Str::ucfirst |
| upper | Str::upper |
