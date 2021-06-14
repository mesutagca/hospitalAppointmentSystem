<?php


namespace App\Filters\MedicineCompany;


use App\Filters\BaseFilter\QueryFilters;
use Illuminate\Database\Eloquent\Builder;

class MedicineCompanyListFilters extends QueryFilters
{
    public function filterByName($name): Builder
    {
        return $this->builder->where('medicine_companies.name', 'LIKE', $name);
    }

    public function filterByAddress($address): Builder
    {
        return $this->builder->where('medicine_companies.address', 'LIKE', $address);
    }

    public function filterBySearch($filter): Builder
    {
        return $this->builder->where(function (Builder $query) use ($filter) {
            $query->where('medicine_companies.name', 'LIKE', '%' . $filter . '%')
            ->orWhere('medicine_companies.address', 'LIKE', '%' . $filter . '%');
        });
    }


}
