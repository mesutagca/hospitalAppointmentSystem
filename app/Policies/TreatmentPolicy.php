<?php


namespace App\Policies;


use App\Enums\UserTypes;
use App\Models\Appointment;
use App\Models\Treatment;
use App\Models\User;
use App\Policies\Traits\PolicyCommonTrait;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class TreatmentPolicy
{
    use HandlesAuthorization;
    use PolicyCommonTrait;

    public function treatPatient(User $user, Appointment $appointment):Response
    {
        if($user->doctor->id==$appointment->doctor_id){
            return $this->allow();
        }
        $this->customDeny('This action is unauthorized.',403);
    }

    public function downloadRecipeMedicines(User $user, Treatment $treatment): Response
    {

        if(Auth::user()->type==UserTypes::DOCTOR && $user->doctor->id==$treatment->folder->appointment->doctor_id){

            return $this->allow();
        }
        if(Auth::user()->type==UserTypes::PATIENT && $user->patient->id==$treatment->folder->appointment->patient_id){
            return $this->allow();
        }

        $this->customDeny('This action is unauthorized.',403);
    }

    public function deleteRecipeMedicines(User $user,Treatment $treatment):Response
    {
        if(Auth::user()->type==UserTypes::DOCTOR && $user->doctor->id==$treatment->folder->appointment->doctor_id){

            return $this->allow();
        }

        $this->customDeny('This action is unauthorized.',403);

    }

}
