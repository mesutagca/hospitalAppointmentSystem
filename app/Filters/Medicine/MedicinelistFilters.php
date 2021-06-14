<?php


namespace App\Filters\Medicine;


use App\Filters\BaseFilter\QueryFilters;
use Illuminate\Database\Eloquent\Builder;

class MedicinelistFilters extends QueryFilters
{
    public function filterByName($name): Builder
    {
        return $this->builder->where('medicines.name', 'LIKE', $name);
    }

    public function filterByMedicineCompanyId($companyId): Builder
    {
        return $this->builder->where('medicines.medicine_company_id', '=', $companyId);
    }

    public function filterByActiveIngredient($activeIngredient): Builder
    {
        return $this->builder->where('medicines.active_ingredient', 'LIKE', $activeIngredient);
    }

    public function filterBySearch($filter): Builder
    {
        return $this->builder->where(function (Builder $query) use ($filter) {
            $query->where('medicines.name', 'LIKE', '%' . $filter . '%')
            ->orWhere('medicines.active_ingredient','LIKE','%'.$filter.'%')
                ->orWhere('medicines.barcode','LIKE','%'.$filter.'%');

        });
    }

}
