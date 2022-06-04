<?php

namespace App\Containers\Authorization\Tasks;

use App\Containers\Authorization\Data\Repositories\PermissionRepository;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

/**
 * Class UpdatePermissionTask
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class UpdatePermissionTask extends Task
{

    /**
     * @var  \App\Containers\Authorization\Data\Repositories\PermissionRepository
     */
    protected $repository;

    /**
     * UpdatePermissionTask constructor.
     *
     * @param \App\Containers\Authorization\Data\Repositories\PermissionRepository $repository
     */
    public function __construct(PermissionRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param string      $name
     * @param string|null $description
     * @param string|null $displayName
     *
     * @return integer
     * @throws UpdateResourceFailedException
     */
    public function run(
        int $id,
        string $description = null,
        string $display_name = null,
        string $guard_name = 'admin'
    ): int
    {
        app()['cache']->forget('spatie.permission.cache');

        try {
            $permission = $this->repository->where('id', $id)->update([
                'description'  => $description,
                'guard_name'   => $guard_name,
                'display_name' => $display_name
            ]);
        } catch (Exception $exception) {
            throw new UpdateResourceFailedException();
        }

        return $permission;
    }
}
