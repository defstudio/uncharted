<?php

namespace DefStudio\Uncharted;


use DefStudio\Uncharted\Charts\Chart;
use DefStudio\Uncharted\Charts\LineChart;
use DefStudio\Uncharted\Data\Dataset;
use Illuminate\Support\HtmlString;

class Uncharted
{
    /**
     * @param Dataset[]|Dataset $datasets
     */
    public function line(array|Dataset $datasets): LineChart
    {
        return new LineChart($datasets);
    }
}
