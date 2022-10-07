<?php

namespace DefStudio\Uncharted;


use DefStudio\Uncharted\Charts\Chart;
use DefStudio\Uncharted\Charts\LineChart;
use DefStudio\Uncharted\Data\Dataset;
use Dflydev\DotAccessData\Data;
use Illuminate\Support\Collection;
use Illuminate\Support\HtmlString;

class Uncharted
{
    /**
     * @param Dataset[]|Collection<int, Dataset>|Dataset $datasets
     */
    public function line(array|Collection|Dataset $datasets): LineChart
    {
        return new LineChart($datasets);
    }
}
