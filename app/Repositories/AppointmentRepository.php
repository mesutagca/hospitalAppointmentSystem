<?php


namespace App\Repositories;

use App\Models\Appointment;
use App\Models\PatientDocument;
use App\Repositories\BaseRepository\BaseEloquentRepository;
use App\Repositories\BaseRepository\Traits\ThrowsHttpExceptions;
use App\Repositories\Contracts\AppointmentRepositoryContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;


class AppointmentRepository extends BaseEloquentRepository implements AppointmentRepositoryContract
{
    use ThrowsHttpExceptions;

    /**
     * @var Model|Builder
     */
    protected $model=Appointment::class;



    protected array $relationships=[
        'patient','patient.user',

        'doctor','doctor.user', 'doctor.branch',

        'folder','folder.diagnose','folder.patientDocuments','folder.treatment','folder.treatment.recipe','folder.treatment.recipe.medicines',
         ];



}
