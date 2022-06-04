<?php

namespace App\Containers\User\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;

/**
 * Class GetAllUsersAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class GetAllUsersAction extends Action
{

    /**
     * @return mixed
     */
    public function run(DataTransporter $filters = null, $limit = 10)
    {

        return Apiato::call('User@GetAllUsersTask',
            [
                $limit
            ],
            [
                'addRequestCriteria',
                ['adminFilter' => [$filters]],
                'ordered',
                'withRole'
            ]
        );
    }
}
