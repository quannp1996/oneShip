<?php

namespace App\Containers\Authorization\Tasks;

use App\Containers\Authorization\Data\Repositories\RoleRepository;
use App\Containers\Authorization\Models\Role;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

/**
 * Class CreateRoleTask.
 *
 * 
 */
class UpdateRoleTask extends Task
{

    /**
     * @var  \App\Containers\Authorization\Data\Repositories\RoleRepository
     */
    protected $repository;

    /**
     * CreateRoleTask constructor.
     *
     * @param \App\Containers\Authorization\Data\Repositories\RoleRepository $repository
     */
    public function __construct(RoleRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int         $id
     * @param string      $name
     * @param string|null $description
     * @param string|null $displayName
     * @param int         $level
     *
     * @return interger
     * @throws UpdateResourceFailedException
     */
    public function run(int $id, string $description = null, string $displayName = null, int $level = 0): int
    {
        app()['cache']->forget('spatie.permission.cache');

        try {
            $role = $this->repository->where('id',$id)->update([
                'description'  => $description,
                'display_name' => $displayName,
                'guard_name'   => 'admin',
                'level'        => $level,
            ]);
        } catch (Exception $exception) {
            throw new UpdateResourceFailedException();
        }

        return $role;
    }

}
