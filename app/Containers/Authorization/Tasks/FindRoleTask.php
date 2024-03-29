<?php

namespace App\Containers\Authorization\Tasks;

use App\Containers\Authorization\Data\Repositories\RoleRepository;
use App\Containers\Authorization\Models\Role;
use App\Ship\Parents\Tasks\Task;

/**
 * Class FindRoleTask.
 *
 * @author Mahmoud Zalt  <mahmoud@zalt.me>
 */
class FindRoleTask extends Task
{

    protected $repository;

    public function __construct(RoleRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param $roleNameOrId
     *
     * @return  \App\Containers\Authorization\Models\Role
     */
    public function run($roleNameOrId): Role
    {
        $role = $this->repository->find($roleNameOrId);
        return $role;
    }

}
