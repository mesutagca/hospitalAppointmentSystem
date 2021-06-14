<?php


namespace App\Filters\Doctor;

use App\Filters\BaseFilter\QueryFilters;
use Illuminate\Database\Eloquent\Builder;

class DoctorListFilters extends QueryFilters
{
    public function filterByBranchId($id): Builder
    {
        return $this->builder->where('doctors.branch_id', 'LIKE', $id);
    }

    public function filterByStatus($status): Builder
    {
        return $this->builder->where('doctors.status', 'LIKE', $status);
    }

    public function filterBySearch($filter): Builder
    {
        return $this->builder->where(function (Builder $query) use ($filter) {
            $query->where('doctors.status', 'LIKE', '%' . $filter . '%');
        });
    }

}
