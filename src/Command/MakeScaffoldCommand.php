<?php

namespace Takemo101\LaravelSimpleTempla\Command;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;
use Takemo101\LaravelSimpleTempla\Scaffold\{
    ScaffoldCollection,
    ScaffoldProcess,
    PathIterator,
};

class MakeScaffoldCommand extends Command
{
    /**
     * @var integer
     */
    const NotFoundScaffoldProcessError = -1;

    /**
     * @var integer
     */
    const ValidationError = -2;

    /**
     * @var string
     */
    protected $signature = 'make:scaff
		{name : the name of the scaffold process}';

    /**
     * @var string
     */
    protected $description = 'make scaffold process';

    public function __construct(
        private ScaffoldCollection $scaffolds,
        private ScaffoldProcess $process,
    ) {
        parent::__construct();
    }

    /**
     * command handle
     *
     * @return integer
     */
    public function handle()
    {
        $name = $this->argument('name');

        $scaffold = $this->scaffolds->makeByName(
            (string)(is_array($name) ? array_unshift($name) : $name),
        );

        // not found scaffold name error
        if (!$scaffold) {
            $this->error('not found scaffold process');
            return self::NotFoundScaffoldProcessError;
        }

        $rules = $scaffold->rules();
        $names = array_keys($rules);
        $options = [];

        // input options
        foreach ($names as $name) {
            $this->newLine();
            $option = $this->ask("please input [{$name}]");
            $this->info("{$name}: {$option}");
            $options[$name] = $option;
        }

        $validator = Validator::make($options, $rules);

        // validation error
        if ($validator->fails()) {

            $this->newLine();
            $this->error('input error!');

            $errors = $validator->errors();
            foreach ($errors->all() as $error) {
                $this->newLine();
                $this->error($error);
            }
            return self::ValidationError;
        }

        $this->process->execute(
            PathIterator::fromStrings(
                $scaffold->inoutPaths(),
            ),
            $validator->validated(),
        );

        return 0;
    }
}
