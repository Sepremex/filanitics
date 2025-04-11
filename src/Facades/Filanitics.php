<?php

namespace Sepremex\Filanitics\Facades;

use Sepremex\Filanitics\Filanitics as FGA;
use Illuminate\Support\Facades\Facade;

/**
 * @method static thousandsFormater()
 * @method static for()
 *
 * @see \Sepremex\Filanitics\Filanitics
 */
class Filanitics extends Facade
{
    protected static function getFacadeAccessor()
    {
        return FGA::class;
    }
}
