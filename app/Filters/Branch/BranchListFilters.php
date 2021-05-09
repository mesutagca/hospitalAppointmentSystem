<?php


namespace App\Filters\Branch;


use App\Filters\BaseFilter\QueryFilters;
use Illuminate\Database\Eloquent\Builder;

class BranchListFilters extends QueryFilters
{
    public function filterByName($name):Builder
    {
        return $this->builder->where('branches.name','LIKE', $name);
    }


    /**
     * @return Builder|null
     */
    /*
    protected function mandatoryFilters(): ?Builder
    {
        if (Authenticated::user()->organizationType == OrganizationTypes::ENDUSER) {
            return $this->builder->where('folders.installation_id', '=', Authenticated::user()->installationId);
        }

        return null;
    }*/

}
