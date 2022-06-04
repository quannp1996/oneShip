<?php

namespace App\Containers\User\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\User\Models\UserLog;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;

/**
 * Class FindUserByIdAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class FindUserLogByIdAction extends Action
{

    /**
     * @param \App\Ship\Transporters\DataTransporter $data
     *
     * @return  \App\Containers\User\Models\User
     */
    public function run($data): UserLog
    {
        $userLog = Apiato::call('User@FindUserLogByIdTask', [$data->id],[
            'addRequestCriteria',
            'withUser'
        ]);

        if (!$userLog) {
            throw new NotFoundException();
        }

        return $userLog;
    }

}
