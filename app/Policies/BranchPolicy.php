<?php


namespace App\Policies;


use App\Enums\OrganizationTypes;
use App\Models\User;
use App\Policies\Traits\PolicyCommonTrait;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

/**
 * Class FolderPolicy
 * @package App\Policies
 * @SuppressWarnings(PHPMD.UnusedFormalParameter)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 */
class BranchPolicy
{
    use HandlesAuthorization;
    use PolicyCommonTrait;

    /**
     * @param User|null $user
     * @return Response
     */
    public function create(?User $user): Response
    {
        //check for users
        $this->validateOperationalType([OrganizationTypes::DOCTOR && OrganizationTypes::PATIENT]);

        $this->isAdmin();

        return $this->allow();
    }

}
