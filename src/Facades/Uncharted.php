<?php

namespace DefStudio\Uncharted\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \DefStudio\Uncharted\Uncharted
 */
class Uncharted extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \DefStudio\Uncharted\Uncharted::class;
    }
}
