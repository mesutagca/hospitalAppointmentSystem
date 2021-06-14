<?php


namespace App\Filters\Branch;


use App\Filters\BaseFilter\QueryFilters;
use Illuminate\Database\Eloquent\Builder;

class BranchListFilters extends QueryFilters
{
    public function filterByName($name): Builder
    {
        return $this->builder->where('branches.name', 'LIKE', $name);
    }

    public function filterBySearch($filter): Builder
    {
        return $this->builder->where(function (Builder $query) use ($filter) {
            $query->where('branches.name', 'LIKE', '%' . $filter . '%');
        });
    }


}
