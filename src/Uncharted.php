<?php

namespace DefStudio\Uncharted;

use DefStudio\Uncharted\Charts\LineChart;
use DefStudio\Uncharted\Data\Dataset;
use Illuminate\Support\Collection;

class Uncharted
{
    /**
     * @param  Dataset[]|Collection<int, Dataset>|Dataset  $datasets
     */
    public function line(array|Collection|Dataset $datasets): LineChart
    {
        return new LineChart($datasets);
    }
}
