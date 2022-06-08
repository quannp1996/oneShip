<?php

namespace App\Containers\User\Tasks;

use App\Containers\User\Data\Repositories\UserRepository;
use App\Containers\User\Models\User;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

/**
 * Class DeleteUserTask
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class DeleteUserTask extends Task
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
     * @throws DeleteResourceFailedException
     */
    public function run(User $user)
    {
        try {
            $result = $user->update([
                'status' => config('user-container.user_status_removed')
            ]);
            if($result) {
                return $this->repository->delete($user->id);
            }
            throw new DeleteResourceFailedException();
        }
        catch (Exception $exception) {
            throw new DeleteResourceFailedException();
        }
    }
}
