<?php

namespace DefStudio\Uncharted\Charts;

use DefStudio\Uncharted\Data\Dataset;
use Dflydev\DotAccessData\Data;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

abstract class Chart
{
    /** @var Collection<int, Dataset> */
    private Collection $datasets;

    /**
     * @param Dataset[]|Dataset $datasets
     */
    public function __construct(array|Dataset $datasets)
    {
        $this->datasets = Collection::make(Arr::wrap($datasets))->values();
    }

    abstract public function type(): string;

    public function config(): array
    {
        return [
            'type' => $this->type(),
            'data' => [
                'labels' => ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                'datasets' => $this->datasets->map(fn (Dataset $dataset) => [
                    'label' => $dataset->label,
                    'data' => $dataset->data,
                ])
            ],
        ];
    }
}
