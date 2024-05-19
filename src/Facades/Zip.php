<?php

namespace Hyder\LaravelUtils\Facades;


/**
 * @method static \Hyder\Zipify\Services\ZipFacadeService dir(string $path)
 * @method static \Hyder\Zipify\Services\ZipFacadeService create()
 */

use Illuminate\Support\Facades\Facade;

class Zip extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'zip-facade-service';
    }
}
