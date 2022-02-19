<?php

namespace Test;

use Takemo101\LaravelSimpleTempla\SimpleTemplaFacade as SimpleTempla;

class FilterTest extends TestCase
{
    /**
     * @test
     */
    public function executeFilter__OK(): void
    {
        $this->assertEquals(
            SimpleTempla::parse('{{ data|camel }}', ['data' => 'HelloWorld']),
            'helloWorld',
            'camel',
        );
        $this->assertEquals(
            SimpleTempla::parse('{{ data|headline }}', ['data' => 'hello']),
            'Hello',
            'headline',
        );
        $this->assertEquals(
            SimpleTempla::parse('{{ data|kebab }}', ['data' => 'HelloWorld']),
            'hello-world',
            'kebab',
        );
        $this->assertEquals(
            SimpleTempla::parse('{{ data|lower }}', ['data' => 'HELLO']),
            'hello',
            'lower',
        );
        $this->assertTrue(
            strpos(
                SimpleTempla::parse('{{ data|markdown }}', ['data' => '# title']),
                '<h1>title</h1>'
            ) === 0,
            'markdown',
        );
        $this->assertEquals(
            SimpleTempla::parse('{{ data|plural }}', ['data' => 'library']),
            'libraries',
            'plural',
        );
        $this->assertEquals(
            SimpleTempla::parse('{{ data|reverse }}', ['data' => 'hello']),
            'olleh',
            'reverse',
        );
        $this->assertEquals(
            SimpleTempla::parse('{{ data|singular }}', ['data' => 'libraries']),
            'library',
            'singular',
        );
        $this->assertEquals(
            SimpleTempla::parse('{{ data|slug }}', ['data' => 'Hello World']),
            'hello-world',
            'slug',
        );
        $this->assertEquals(
            SimpleTempla::parse('{{ data|snake }}', ['data' => 'Hello World']),
            'hello_world',
            'snake',
        );
        $this->assertEquals(
            SimpleTempla::parse('{{ data|studly }}', ['data' => 'hello_world']),
            'HelloWorld',
            'studly',
        );
        $this->assertEquals(
            SimpleTempla::parse('{{ data|title }}', ['data' => 'hello world']),
            'Hello World',
            'title',
        );
        $this->assertEquals(
            SimpleTempla::parse('{{ data|ucfirst }}', ['data' => 'hello']),
            'Hello',
            'ucfirst',
        );
        $this->assertEquals(
            SimpleTempla::parse('{{ data|upper }}', ['data' => 'hello']),
            'HELLO',
            'upper',
        );
    }

    /**
     * @test
     */
    public function executeOriginalFilter__OK(): void
    {
        $this->assertEquals(
            SimpleTempla::parse('{{ data|demo }}', ['data' => 'hello']),
            '===hello===',
            'demo',
        );
    }
}
