<?php


namespace App\Repositories;


use App\Models\MedicineCompany;
use App\Repositories\BaseRepository\BaseEloquentRepository;
use App\Repositories\BaseRepository\Traits\ThrowsHttpExceptions;
use App\Repositories\Contracts\MedicineCompanyRepositoryContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;


class MedicineCompanyRepository extends BaseEloquentRepository implements MedicineCompanyRepositoryContract
{
    use ThrowsHttpExceptions;

    /**
     * @var Model|Builder
     */
    protected $model = MedicineCompany::class;

    protected array $relationships = ['medicines'];
}
