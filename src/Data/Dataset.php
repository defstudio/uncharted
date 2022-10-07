<?php

namespace DefStudio\Uncharted\Data;

use Illuminate\Support\Arr;

class Dataset
{
    public array $data = [];

    private function __construct(public readonly string $label)
    {
    }

    public static function make(string $label): self
    {
        return new self($label);
    }

    public function data(int|float|array $data): self
    {
        foreach (Arr::wrap($data) as $datum){
            $this->data[] = $datum;
        }
        return $this;
    }
}
