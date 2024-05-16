<?php

namespace Hyder\LaravelUtils\Services;

use ReflectionEnum;

class EnumFacadeService
{
    protected array $enums = [];

    protected string $enumDirectory = '';

    protected string $enumNamespace = ''; 

    public function __construct()
    {
        $this->enumDirectory = config('laravel-utils.enums.dir_path');
        $this->enumNamespace = config('laravel-utils.enums.namespace');
    }

    public function setDirectory(string $directory): EnumFacadeService
    {
        $this->enumDirectory = $directory;
        return $this;
    }

    public function setNamespace(string $namespace): EnumFacadeService
    {
        $this->enumNamespace = $namespace;
        return $this;
    }

    public function list(): array
    {
        $this->includeEnumsFromDirectory($this->enumDirectory);
        return $this->enums;
    }

    private function includeEnumsFromDirectory(string $directory): void
    {
        $items = scandir($directory);

        foreach ($items as $item) {
            try {

                if ($item === '.' || $item === '..') {
                    continue;
                }

                $path = $directory . '/' . $item;

                if (is_dir($path)) {
                    $this->includeEnumsFromDirectory($path);
                } elseif (pathinfo($path, PATHINFO_EXTENSION) === 'php') {

                    require_once $path;

                    $enumName = pathinfo($item, PATHINFO_FILENAME);

                    $namespace = str_replace($this->enumDirectory, $this->enumNamespace, $directory);
                    $fullyQualifiedEnumName = str_replace('/', '\\', $namespace) . '\\' . $enumName;

                    $reflection = new ReflectionEnum($fullyQualifiedEnumName);
                    $this->enums[$fullyQualifiedEnumName] = $reflection->getConstants();
                }
            } catch (\Exception $ex) {
                //
            }
        }
    }
}
