<?php

namespace App\Containers\User\Tasks;

use App\Containers\User\Data\Criterias\WithUserCriteria;
use App\Containers\User\Data\Repositories\UserLogRepository;
use App\Containers\User\Models\UserLog;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;

/**
 * Class FindUserByIdTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class FindUserLogByIdTask extends Task
{

    protected $repository;

    public function __construct(UserLogRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param $userId
     *
     * @return User
     * @throws NotFoundException
     */
    public function run($userLogId): UserLog
    {
        // find the user log by its id
        try {
            $userLog = $this->repository->find($userLogId);
        } catch (Exception $e) {
            throw new NotFoundException();
        }

        return $userLog;
    }

    public function withUser()
    {
        $this->repository->pushCriteria(new WithUserCriteria());
    }

}
