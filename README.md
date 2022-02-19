# The Simple Templa For Laravel
This package is a wrap of Simple Templa for Laravel.  
A Scaffold function using Simple Templa has also been added.

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

use App\Scaffold\DemoScaffold;

return [
    ...
    'scaffolds' => [
        'demo' => DemoScaffold::class,
    ],
]
```
```
<?php

namespace App\Scaffold;

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
After setting the Scaffold class, run Artisan to create the file.
```
$ php artisan exec:scaff demo
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
