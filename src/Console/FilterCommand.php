<?php

namespace Zarate\Console;

use Illuminate\Console\GeneratorCommand;

class FilterCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:filter';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'class';

    /**
     * The console command description.
     *
     * @var string|null
     */
    protected $description = 'Create a new filter class';

    protected function getStub()
    {
        return app_path().'/Console/Stubs/custom-filter.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Filters';
    }
}