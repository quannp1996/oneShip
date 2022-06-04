<?php

namespace App\Containers\Authorization\Tasks;

use App\Containers\Authorization\Data\Criterias\OrderByCreatedCriteria;
use App\Containers\Authorization\Data\Criterias\EqualNameCriteria;
use App\Containers\Authorization\Data\Criterias\LikeDispNameCriteria;
use App\Containers\Authorization\Data\Criterias\WhereInGuardCriteria;
use App\Containers\Authorization\Data\Repositories\RoleRepository;
use App\Ship\Parents\Tasks\Task;
use App\Ship\Transporters\DataTransporter;

/**
 * Class GetAllRolesTask.
 *
 * @author Mahmoud Zalt  <mahmoud@zalt.me>
 */
class GetAllRolesTask extends Task
{

    protected $repository;

    public function __construct(RoleRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param bool $skipPagination
     *
     * @return  mixed
     */
    public function run($skipPagination = false, $limit = 10)
    {
        // if ($filters->name) {
        //     $this->repository->pushCriteria(new EqualNameCriteria($filters->name));
        // }

        // if ($filters->display_name) {
        //     $this->repository->pushCriteria(new LikeDispNameCriteria($filters->display_name));
        // }

        return $skipPagination ? $this->repository->all() : $this->repository->paginate($limit);
    }

    public function ordereByCreated()
    {
        $this->repository->pushCriteria(new OrderByCreatedCriteria());
    }

    public function equalName($name) {
        $this->repository->pushCriteria(new EqualNameCriteria($name));
    }

    public function likeDispName($dispName) {
        $this->repository->pushCriteria(new LikeDispNameCriteria($dispName));
    }

    public function inGuards($guards=[]) {
      $this->repository->pushCriteria(new WhereInGuardCriteria($guards));
    }
}
