<?php

namespace App\Containers\Authorization\Tasks;

use App\Containers\Authorization\Data\Repositories\PermissionRepository;
use App\Containers\Authorization\Models\Permission;
use App\Ship\Parents\Tasks\Task;

/**
 * Class FindPermissionTask.
 *
 * @author Mahmoud Zalt  <mahmoud@zalt.me>
 */
class FindPermissionTask extends Task
{

    protected $repository;

    public function __construct(PermissionRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param $permissionNameOrId
     *
     * @return  Permission
     */
    public function run($permissionNameOrId): ?Permission
    {
        $permission = $this->repository->find($permissionNameOrId);
        return $permission;
    }

}
