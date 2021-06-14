<?php


namespace App\Policies;


use App\Enums\UserTypes;
use App\Models\Doctor;
use App\Models\User;
use App\Policies\Traits\PolicyCommonTrait;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class DoctorPolicy
{
    use HandlesAuthorization;
    use PolicyCommonTrait;

    /**
     * @param User $user
     * @return Response
     */
    public function index(User $user): Response
    {
        $this->validateOperationalType($user->type, [UserTypes::ADMIN ]);
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
            UserTypes::ADMIN
        ]);
        return $this->allow();
    }

    /**
     * @param User $user
     * @param Doctor $doctor
     * @return Response
     */
    public function update(User $user, Doctor $doctor): Response
    {
        $this->validateOperationalType($user->type, [
            UserTypes::ADMIN
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
            UserTypes::ADMIN
        ]);
        return $this->allow();
    }
}
