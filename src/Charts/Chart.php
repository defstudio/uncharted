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
    private array $options = ['foo' => 'bar'];

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

    public function time(string $unit, string $axis = 'x'): self
    {
        return $this
            ->option("scales.$axis.type", 'time')
            ->option("scales.$axis.time.unit", $unit);

        return $this;
    }

    public function max(float $number, string $axis = null): self
    {
        $axis ??= match ($this::class){
            RadarChart::class => 'r',
            default => 'x'
        };

        return $this->option("scales.$axis.max", $number);

        return $this;
    }

    public function min(float $number, string $axis = null): self
    {
        $axis ??= match ($this::class){
            RadarChart::class => 'r',
            default => 'x'
        };

        return $this->option("scales.$axis.min", $number);
    }

    public function option(string $key, mixed $value): self
    {
        data_set($this->options, $key, $value);

        return $this;
    }

    public function maintainAspectRatio(bool $enable = true): self
    {
        return $this->option('maintainAspectRatio', $enable);
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

    public function render(int $width = 400, int $height = 400): HtmlString
    {
        return new HtmlString(view('uncharted::chart')->with('chart', $this)->with('width', $width)->with('height', $height));
    }
}
