<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ServiceMakeCommand extends GeneratorCommand
{

    protected $name = 'core:make-service';

    protected $description = 'Create core service';

    protected $type = 'Service';

    protected $originName = '';

    public function handle()
    {
        $this->getOriginName();
        $this->createServiceInterface();
        parent::handle();
    }

    protected function createServiceInterface()
    {
        $name = $this->originName;
        $this->call('make:interface', [
            'name'  => "{$name}ServiceContract",
            '-s'   => true
        ]);        
    }

    protected function getOriginName()
    {
        $serviceName = Str::studly($this->argument('name'));

        if(str_contains($serviceName, $this->type))
        {
            $serviceName = substr($serviceName, 0, strpos($serviceName, $this->type));
        }
        $this->originName = class_basename($serviceName);
    }
 
    protected function getStub()
    {
        return __DIR__.'/Stubs/Service.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return 'Core\Services';
    }

    protected function rootNamespace()
    {
        return "Core\\";
    }

    protected function buildClass($name)
    {   

        return str_replace( 
            ['{{ serviceName }}'], 
            $this->originName, 
            parent::buildClass($name)
        );
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
