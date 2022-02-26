<?php

namespace Takemo101\LaravelSimpleTempla\Command;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;
use Takemo101\LaravelSimpleTempla\Scaffold\{
    ScaffoldCollection,
    ScaffoldProcess,
    PathIterator,
};

class ExecScaffoldCommand extends Command
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
    protected $signature = 'simple-templa:exec
		{name : The name of the scaffold process}';

    /**
     * @var string
     */
    protected $description = 'Execute the scaffold process';

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
        $name = (string)(is_array($name) ? array_unshift($name) : $name);

        $scaffold = $this->scaffolds->makeByName(
            $name,
        );

        // scaffold name error
        if (!$scaffold) {
            $this->warn("--- Argument error ---");
            $this->warn("Scaffold process not found: {$name}");
            return self::NotFoundScaffoldProcessError;
        }

        $rules = $scaffold->rules();
        $names = array_keys($rules);
        $options = [];

        // input options
        foreach ($names as $name) {
            $options[$name] = $this->ask("please input [{$name}]");
        }

        $validator = Validator::make($options, $rules);

        // validation error
        if ($validator->fails()) {

            $this->warn('--- Input error! ---');

            $errors = $validator->errors();
            foreach ($errors->all() as $error) {
                $this->warn($error);
            }
            return self::ValidationError;
        }

        // gate validated data
        $data = $validator->validated();

        $this->process->execute(
            PathIterator::fromStrings(
                $scaffold->inoutPaths($data),
            ),
            $data,
        );

        $this->info('The file was created successfully');

        return 0;
    }
}
