<?php

namespace App\Containers\User\Tasks;

use App\Containers\User\Data\Repositories\UserRepository;
use App\Ship\Parents\Tasks\Task;

/**
 * Class GetOptStatusTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class GetOptStatusTask extends Task
{

    /**
     * @var  \App\Containers\User\Data\Repositories\UserRepository
     */
    protected $repository;

    /**
     * GetOptStatusTask constructor.
     *
     * @param \App\Containers\User\Data\Repositories\UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run()
    {
        return $this->repository->getStatusOpt();
    }
}