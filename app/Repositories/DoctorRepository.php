<?php


namespace App\Repositories;


use App\Models\Doctor;
use App\Repositories\BaseRepository\BaseEloquentRepository;
use App\Repositories\BaseRepository\Traits\ThrowsHttpExceptions;
use App\Repositories\Contracts\DoctorRepositoryContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class DoctorRepository extends BaseEloquentRepository implements DoctorRepositoryContract
{
    use ThrowsHttpExceptions;

    /**
     * @var Model|Builder
     */
    protected $model=Doctor::class;

    protected array $relationships=['user','branch', 'appointments','doctorDocuments'];



}
