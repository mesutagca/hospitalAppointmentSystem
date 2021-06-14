<?php


namespace App\Repositories;


use App\Models\Appointment;
use App\Models\Patient;
use App\Repositories\BaseRepository\BaseEloquentRepository;
use App\Repositories\BaseRepository\Traits\ThrowsHttpExceptions;
use App\Repositories\Contracts\PatientrepositoryContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class PatientRepository extends BaseEloquentRepository implements PatientrepositoryContract
{
    use ThrowsHttpExceptions;

    /**
     * @var Model|Builder
     */
    protected $model=Patient::class;

    protected array $relationships=['user', 'appointments'];

}
