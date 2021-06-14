<?php

namespace App\Policies;

use App\Enums\UserTypes;
use App\Models\Appointment;
use App\Models\PatientDocument;
use App\Models\User;
use App\Policies\Traits\PolicyCommonTrait;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class PatientDocumentPolicy
{
   use HandlesAuthorization;
    use PolicyCommonTrait;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


}
