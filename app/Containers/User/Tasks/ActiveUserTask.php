<?php

namespace App\Containers\User\Tasks;

use App\Containers\User\Data\Repositories\UserRepository;
use App\Containers\User\Models\User;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

/**
 * Class ActiveUserTask
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class ActiveUserTask extends Task
{

    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     *
     * @param User $user
     *
     * @return bool
     * @throws UpdateResourceFailedException
     */
    public function run(User $user)
    {
        try {
            return $user->update([
                'active' => $user->active == 0 ? 1 : 0
            ]);
//            throw new UpdateResourceFailedException();
        }
        catch (Exception $exception) {
            throw new UpdateResourceFailedException();
        }
    }
}
