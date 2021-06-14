<?php


namespace App\Filters\BaseFilter;

use App\Enums\UserTypes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class QueryFilters
{
    protected array $filterArray;
    protected Builder $builder;

    public function apply(Builder $builder): Builder
    {
        $this->builder = $builder;
        foreach ($this->filters() as $name => $value) {
            $method = "filterBy".Str::studly($name);
            if (! method_exists($this, $method)) {
                continue;
            }

            if (strlen($value)) {
                $this->$method($value);
                continue;
            }

            $this->$method();
        }

        $this->mandatoryFilters();
        return $this->builder;
    }

    public function filters(): array
    {
        return $this->filterArray;
    }

    public function setFilters(array $filterArray = []): void
    {
        $this->filterArray = $filterArray;
    }

    protected function mandatoryFilters(): ?Builder
    {
             return null;
    }


}
