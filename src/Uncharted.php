<?php

namespace DefStudio\Uncharted;


use DefStudio\Uncharted\Charts\LineChart;
use DefStudio\Uncharted\Data\Dataset;
use Illuminate\Support\HtmlString;

class Uncharted
{
    /**
     * @param Dataset[]|Dataset $datasets
     *
     * @return HtmlString
     */
    public function line(array|Dataset $datasets): HtmlString
    {
        return new HtmlString(view('uncharted::chart')->with('chart', new LineChart($datasets)));
    }
}
