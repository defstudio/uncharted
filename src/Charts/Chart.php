<?php

namespace DefStudio\Uncharted\Charts;

use DefStudio\Uncharted\Data\Dataset;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\HtmlString;

abstract class Chart
{
    /** @var Collection<int, Dataset> */
    private Collection $datasets;

    /** @var string[] */
    private array $labels;

    /** @var array<string, mixed> */
    private array $options = [];

    /**
     * @param  Dataset[]|Collection<int, Dataset>|Dataset  $datasets
     */
    public function __construct(array|Collection|Dataset $datasets)
    {
        $this->datasets = $datasets instanceof Collection
            ? $datasets
            : Collection::make(Arr::wrap($datasets));
    }

    abstract protected function type(): string;

    private function data(): array
    {
        return collect([
            'datasets' => $this->datasets->map(fn (Dataset $dataset) => $dataset->config()),
        ])->when(isset($this->labels), fn (Collection $collection) => $collection->put('labels', $this->labels))
            ->toArray();
    }

    public function time(string $unit): self
    {
        $this->options['scales']['x'] = [
            'type' => 'time',
            'time' => [
                'unit' => $unit,
            ],
        ];

        return $this;
    }

    /**
     * @param  string[]  $labels
     */
    public function labels(array $labels): self
    {
        $this->labels = $labels;

        return $this;
    }

    public function config(): array
    {
        return [
            'type' => $this->type(),
            'data' => $this->data(),
            'options' => $this->options,
        ];
    }

    public function render(): HtmlString
    {
        return new HtmlString(view('uncharted::chart')->with('chart', $this));
    }
}
