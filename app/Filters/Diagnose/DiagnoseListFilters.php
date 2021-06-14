<?php


namespace App\Filters\Diagnose;

use App\Filters\BaseFilter\QueryFilters;
use Illuminate\Database\Eloquent\Builder;

class DiagnoseListFilters extends QueryFilters
{

    public function filterByName($name): Builder
    {
        return $this->builder->where('diagnoses.name', 'LIKE', $name);
    }

    public function filterBySearch($filter): Builder
    {
        return $this->builder->where(function (Builder $query) use ($filter) {
            $query->where('diagnoses.name', 'LIKE', '%' . $filter . '%');

        });
    }
}
