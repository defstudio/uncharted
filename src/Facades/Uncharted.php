<?php

namespace DefStudio\Uncharted\Facades;

use DefStudio\Uncharted\Charts\LineChart;
use DefStudio\Uncharted\Data\Dataset;
use Illuminate\Support\Facades\Facade;

/**
 * @method LineChart line(Dataset[]|Dataset $datasets)
 * @see \DefStudio\Uncharted\Uncharted
 */
class Uncharted extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \DefStudio\Uncharted\Uncharted::class;
    }
}
