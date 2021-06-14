<?php


namespace App\Policies;


use App\Enums\UserTypes;
use App\Models\MedicineCompany;
use App\Models\User;
use App\Policies\Traits\PolicyCommonTrait;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class MedicineCompanyPolicy
{
    use HandlesAuthorization;
    use PolicyCommonTrait;

    /**
     * @param User $user
     * @return Response
     */
    public function index(User $user): Response
    {
        $this->validateOperationalType($user->type, [UserTypes::ADMIN]);

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
     * @param MedicineCompany $medicine
     * @return Response
     */
    public function update(User $user, MedicineCompany $medicine): Response
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
