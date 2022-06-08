<?php

namespace App\Containers\Authorization\Tasks;

use App\Containers\Authorization\Data\Criterias\EqualNameCriteria;
use App\Containers\Authorization\Data\Criterias\LikeDispNameCriteria;
use App\Containers\Authorization\Data\Criterias\OrderByContainerCriteria;
use App\Containers\Authorization\Data\Criterias\OrderByCreatedCriteria;
use App\Containers\Authorization\Data\Criterias\WhereInGuardCriteria;
use App\Containers\Authorization\Data\Repositories\PermissionRepository;
use App\Ship\Criterias\Eloquent\ThisOperationThatCriteria;
use App\Ship\Parents\Tasks\Task;
use App\Ship\Transporters\DataTransporter;

/**
 * Class GetAllPermissionsTask.
 *
 * @author Mahmoud Zalt  <mahmoud@zalt.me>
 */
class GetAllPermissionsTask extends Task
{

    /**
     * @var PermissionRepository
     */
    protected $repository;

    /**
     * GetAllPermissionsTask constructor.
     *
     * @param PermissionRepository $repository
     */
    public function __construct(PermissionRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param bool $skipPagination
     *
     * @return  mixed
     */
    public function run($skipPagination = false,$limit = 10,$filters = [])
    {
        if (!empty($filters->name)) {
            $this->repository->pushCriteria(new ThisOperationThatCriteria('name', "%{$filters->name}%", 'like'));
        }

        if (!empty($filters->display_name)) {
            $this->repository->pushCriteria(new ThisOperationThatCriteria('display_name', "%{$filters->display_name}%",'like'));
        }

        return $skipPagination ? $this->repository->all() : $this->repository->paginate($limit);
    }

    public function ordereByContainer()
    {
        $this->repository->pushCriteria(new OrderByContainerCriteria());
    }

    public function ordereByCreated()
    {
        $this->repository->pushCriteria(new OrderByCreatedCriteria());
    }

    public function equalName($name)
    {
        $this->repository->pushCriteria(new EqualNameCriteria($name));
    }

    public function likeDispName($dispName)
    {
        $this->repository->pushCriteria(new LikeDispNameCriteria($dispName));
    }

    public function inGuards(array $guards=['admin']) {
      $this->repository->pushCriteria(new WhereInGuardCriteria($guards));
    }
}
