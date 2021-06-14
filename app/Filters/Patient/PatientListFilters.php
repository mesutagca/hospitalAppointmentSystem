<?php


namespace App\Filters\Patient;


use App\Filters\BaseFilter\QueryFilters;
use Illuminate\Database\Eloquent\Builder;

class PatientListFilters extends QueryFilters
{
    public function filterById($id): Builder
    {
        return $this->builder->where('patients.user_id', 'LIKE', $id);
    }

}
