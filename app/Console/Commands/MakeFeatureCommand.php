<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeFeatureCommand extends Command
{
    protected $signature = 'make:feature {name : The name of the feature}';
    protected $description = 'Create a new feature class';

    public function handle()
    {
        $name = $this->argument('name');

        // replace / to \
        $name = str_replace('/', '\\', $name);

        // get the name of the class
        $featureClassName = Str::studly($name);
        $featureFilePath = app_path("Http/Features/{$name}.php");

        $this->info("Creating feature class: {$featureClassName}");
        // dd($name);

        // verify if directory not exists and create
        $afterName = Str::afterLast($name, '\\');
        $featureDirectory = app_path("Http/Features/{$afterName}");
        if (!File::isDirectory($featureDirectory)) {
            File::makeDirectory($featureDirectory, 0755, true);
        }

        if (File::exists($featureFilePath)) {
            $this->error("Feature class already exists: {$featureClassName}");
            return;
        }

        $stub = $this->getStub();

        File::put($featureFilePath, $this->replaceNamespace($stub, $featureClassName));

        $this->info("Feature class created successfully: {$featureClassName}");
    }

    protected function getStub()
    {
        // Puedes personalizar el contenido de tu plantilla
        return File::get(resource_path('stubs/feature.stub'));
    }

    protected function replaceNamespace($stub, $nameSpace)
    {
        /* if has / take de chars after this */
        $className = Str::afterLast($nameSpace, '\\');
        $nameSpace = Str::beforeLast($nameSpace, '\\');

        $stub = str_replace(
            'DummyNamespace',
            'App\\Http\\Features\\' . $nameSpace,
            $stub
        );

        return str_replace('DummyClass', $className, $stub);
    }
}

