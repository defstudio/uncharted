<?php

namespace DefStudio\Uncharted;

use DefStudio\Uncharted\Charts\LineChart;
use DefStudio\Uncharted\Charts\RadarChart;
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

    public function radar(array|Collection|Dataset $datasets): RadarChart
    {
        return new RadarChart($datasets);
    }
}
