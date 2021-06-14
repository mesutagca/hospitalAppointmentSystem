<?php


namespace App\Policies;


use App\Enums\UserTypes;
use App\Models\Appointment;
use App\Models\PatientDocument;
use App\Models\User;
use App\Policies\Traits\PolicyCommonTrait;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class AppointmentPolicy
{
    use HandlesAuthorization;
    use PolicyCommonTrait;

    public function index(User $user): Response
    {
        $this->validateOperationalType($user->type, [
            UserTypes::ADMIN,
            UserTypes::DOCTOR,
            UserTypes::PATIENT,]);
        return $this->allow();
    }

    /**
     * @param User $user
     * @return Response
     */
    public function list(User $user): Response
    {
        $this->validateOperationalType($user->type, [
            UserTypes::ADMIN,
            UserTypes::DOCTOR,
            UserTypes::PATIENT,
        ]);
        return $this->allow();
    }

    /**
     * @param User $user
     * @return Response
     */
    public function show(User $user): Response
    {
        $this->validateOperationalType($user->type, [
            UserTypes::ADMIN,
            UserTypes::DOCTOR,
            UserTypes::PATIENT,
        ]);
        return $this->allow();
    }

    /**
     * @param User $user
     * @return Response
     */
    public function store(User $user): Response
    {
        $this->validateOperationalType($user->type, [
            UserTypes::PATIENT,
        ]);
        return $this->allow();
    }

    /**
     * @param User $user
     * @param Appointment $appointment
     * @return Response
     */
    public function update(User $user, Appointment $appointment): Response
    {
        $this->validateOperationalType($user->type, [
            UserTypes::PATIENT,
        ]);
        return $this->allow();
    }

    /**
     * @param User $user
     * @return Response
     */
    public function delete(User $user): Response
    {
        $this->validateOperationalType($user->type,[
            UserTypes::DOCTOR,
            UserTypes::PATIENT,
        ]);
        return $this->allow();
    }

    public function documentDownload(User $user, Appointment $appointment): Response
    {
        if($user->patient->id==$appointment->patient_id||
           $user->doctor->id==$appointment->doctor_id){
            return $this->allow();
        }
        $this->customDeny('This action is unauthorized.',403);

    }

    public function documentDelete(User $user,Appointment $appointment): Response
    {
        if(Auth::user()->type==UserTypes::PATIENT && $user->patient->id==$appointment->patient_id){
             return $this->allow();
        }
        $this->customDeny('This action is unauthorized.',403);
    }


}
