<?php


namespace App\Repositories;


use App\Models\Treatment;
use App\Repositories\BaseRepository\BaseEloquentRepository;
use App\Repositories\BaseRepository\Traits\ThrowsHttpExceptions;
use App\Repositories\Contracts\TreatmentRepositoryContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class TreatmentRepository extends BaseEloquentRepository implements TreatmentRepositoryContract
{
    use ThrowsHttpExceptions;

    /**
     * @var Model|Builder
     */
    protected $model=Treatment::class;

    protected array $relationShips= [
        'folder', 'recipe','recipe.medicines','recipe.medicines.medicineCompany'
        ];

}
