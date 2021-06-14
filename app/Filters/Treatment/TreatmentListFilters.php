<?php


namespace App\Filters\Treatment;


use App\Filters\BaseFilter\QueryFilters;
use Illuminate\Database\Eloquent\Builder;

class TreatmentListFilters extends QueryFilters
{
    public function filterBytreatmentId($id): Builder
    {
        return $this->builder->where('treatments.id', 'LIKE', $id)
            ->orwhere('treatments.doctor_id', 'LIKE', $id)
            ->orwhere('treatments.patient_id', 'LIKE', $id);
    }

}
