<?php

namespace App\Containers\User\Tasks;

use App\Containers\User\Data\Criterias\AdminFilterCriteria;
use App\Containers\User\Data\Criterias\WithRoleCriteria;
use App\Containers\User\Data\Repositories\UserRepository;
use App\Ship\Criterias\Eloquent\OrderByCreationDateDescendingCriteria;
use App\Ship\Parents\Tasks\Task;

/**
 * Class GetAllUsersTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class GetAllUsersTask extends Task
{

    /**
     * @var  \App\Containers\User\Data\Repositories\UserRepository
     */
    protected $repository;

    /**
     * GetAllUsersTask constructor.
     *
     * @param \App\Containers\User\Data\Repositories\UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($limit = 20){
        return $this->repository->paginate($limit);
    }

    public function adminFilter($request) {
        $this->repository->pushCriteria(new AdminFilterCriteria($request));
    }

    public function ordered()
    {
        $this->repository->pushCriteria(new OrderByCreationDateDescendingCriteria());
    }

    public function withRole()
    {
        $this->repository->pushCriteria(new WithRoleCriteria());
    }

}
