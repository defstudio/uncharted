<?php

namespace DefStudio\Uncharted;

use DefStudio\Uncharted\Charts\LineChart;
use DefStudio\Uncharted\Data\Dataset;

class Uncharted
{
    /**
     * @param  Dataset[]|Dataset  $datasets
     */
    public function line(array|Dataset $datasets): LineChart
    {
        return new LineChart($datasets);
    }
}
