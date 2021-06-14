<?php


namespace App\Repositories;


use App\Models\Medicine;
use App\Repositories\BaseRepository\BaseEloquentRepository;
use App\Repositories\BaseRepository\Traits\ThrowsHttpExceptions;
use App\Repositories\Contracts\MedicineRepositoryContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class MedicineRepository extends BaseEloquentRepository implements MedicineRepositoryContract
{
    use ThrowsHttpExceptions;

    /**
     * @var Model|Builder
     */
    protected $model = Medicine::class;

    protected array $relationships = ['medicineCompany'];


}
