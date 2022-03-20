<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Exception\InvalidArgumentException;

class ModelMakeCommand extends GeneratorCommand
{
    protected $name = 'core:make-model';

    protected $description = 'Create new core model file';

    protected $type = "Model";

    public function handle()
    {
        parent::handle();
    }

    protected function rootNamespace()
    {
        return "Core\\";
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return "Core\Models";
    }

    protected function getStub()
    {
        return  __DIR__.'/Stubs/Model.stub';
    }

    protected function getPath($name)
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);

        return base_path().'/core/'.str_replace('\\', '/', $name).'.php';
    }

    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the model class.'],
        ];
    }
}
