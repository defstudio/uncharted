<?php

namespace DefStudio\Uncharted\Data;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class Dataset
{
    private array $data = [];
    private string $borderColor;
    private string $backgroundColor;
    private string $textColor;
    private float $tension = 1.0;

    private function __construct(private readonly string $label)
    {
    }

    public static function make(string $label): self
    {
        return new self($label);
    }

    /**
     * @param int|float|array<array-key, int|float>|Collection<array-key, int|float> $data
     *
     * @return $this
     */
    public function data(int|float|array|Collection $data): self
    {
        if ($data instanceof Collection) {
            $data = $data->toArray();
        }

        foreach (Arr::wrap($data) as $datum) {
            $this->data[] = $datum;
        }
        return $this;
    }

    public function borderColor(string $color): self
    {
        $this->borderColor = $color;
        return $this;
    }

    public function textColor(string $color): self
    {
        $this->textColor = $color;
        return $this;
    }

    public function backgroundColor(string $color): self
    {
        $this->backgroundColor = $color;
        return $this;
    }

    public function tension(float $tension): self
    {
        $this->tension = $tension;
        return $this;
    }

    public function config(): array
    {
        $borderColor = $this->borderColor ?? $this->backgroundColor ?? null;
        $backgroundColor = $this->backgroundColor ?? $this->borderColor ?? null;

        return collect(['label' => $this->label, 'data' => $this->data])
            ->when($borderColor, fn(Collection $collection) => $collection->put('borderColor', $borderColor))
            ->when($backgroundColor, fn(Collection $collection) => $collection->put('backgroundColor', $backgroundColor))
            ->when(isset($this->textColor), fn(Collection $collection) => $collection->put('color', $this->textColor))
            ->when(isset($this->tension), fn(Collection $collection) => $collection->put('tension', $this->tension))
            ->toArray();
    }
}
