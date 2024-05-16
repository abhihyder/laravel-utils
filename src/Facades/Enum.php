<?php

namespace Hyder\LaravelUtils\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Enum
 * @package Hyder\LaravelUtils\Facades
 *
 * @method static \Hyder\LaravelUtils\Services\EnumFacadeService setDirectory(string $directory) Set the directory for enum classes. @see \Hyder\LaravelUtils\Services\EnumFacadeService::setDirectory()
 * @method static \Hyder\LaravelUtils\Services\EnumFacadeService setNamespace(string $namespace) Set the namespace for enum classes. @see \Hyder\LaravelUtils\Services\EnumFacadeService::setNamespace()
 * @method static array list() List all available enums. @see \Hyder\LaravelUtils\Services\EnumFacadeService::list()
 */

class Enum extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-utils-enum-facade';
    }
}
