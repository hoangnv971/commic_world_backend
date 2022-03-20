<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Exception\InvalidArgumentException;
use Symfony\Component\Console\Input\InputOption;

class RepositoryMakeCommand extends GeneratorCommand
{

    protected $name = 'core:make-repository';

    protected $description = 'Command make repository';

    protected $type = "Repository";

    protected $originName = "";
  
    public function handle()
    {
        $this->getOriginName();
        $this->createRepositoryInterface();
        parent::handle();
    }

    protected function createRepositoryInterface()
    {
        $name = $this->originName;
    
        $this->call('make:interface', [
            'name'  => "{$name}RepositoryContract",
            '-r'   => true
        ]);        
    }

    protected function getOriginName()
    {
        $repositoryName = Str::studly($this->argument('name'));

        if(str_contains($repositoryName, $this->type))
        {
            $repositoryName = substr($repositoryName, 0, strpos($repositoryName, $this->type));
        }
        $this->originName = class_basename($repositoryName);
    }

    protected function getStub()
    {
        return  __DIR__.'/Stubs/Repository.stub';
    }

    protected function buildClass($name)
    {
        return str_replace( 
            ['{{repositoryName}}', '{{ repositoryName }}', 'repositoryName'], 
            $this->originName, 
            parent::buildClass($name)
        );
    }

    protected function rootNamespace()
    {
        return "Core\\";
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return 'Core\Repositories';
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
