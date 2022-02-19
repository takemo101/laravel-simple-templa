<?php

namespace Test;

use Takemo101\LaravelSimpleTempla\Command\MakeScaffoldCommand;

class CommandTest extends TestCase
{
    /**
     * @test
     */
    public function executeCommand__OK(): void
    {
        $this->artisan(MakeScaffoldCommand::class, [
            'name' => 'demo',
        ])
            ->expectsQuestion('please input [name]', 'name')
            ->expectsQuestion('please input [key]', 'key')
            ->assertExitCode(0);
    }

    /**
     * @test
     */
    public function executeCommand__validation__error__NG(): void
    {
        $this->artisan(MakeScaffoldCommand::class, [
            'name' => 'demo',
        ])
            ->expectsQuestion('please input [name]', '')
            ->expectsQuestion('please input [key]', '')
            ->assertExitCode(MakeScaffoldCommand::ValidationError);
    }

    /**
     * @test
     */
    public function executeCommand__not_found_scaffold_error__NG(): void
    {
        $this->artisan(MakeScaffoldCommand::class, [
            'name' => 'test',
        ])
            ->assertExitCode(MakeScaffoldCommand::NotFoundScaffoldProcessError);
    }
}
