<?php


namespace App\Policies;

use App\Enums\UserTypes;
use App\Models\Diagnose;
use App\Models\User;
use App\Policies\Traits\PolicyCommonTrait;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

/**
 * Class DiagnosePolicy
 * @package App\Policies
 * @SuppressWarnings(PHPMD.UnusedFormalParameter)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 */
class DiagnosePolicy
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
     * @param Diagnose $diagnose
     * @return Response
     */
    public function update(User $user, Diagnose $diagnose): Response
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
