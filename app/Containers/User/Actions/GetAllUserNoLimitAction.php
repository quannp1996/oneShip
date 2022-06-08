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
class GetAllUserNoLimitAction extends Action
{

    /**
     * @return mixed
     */
    public function run(array $filter = [], array $selectedColumn = [])
    {

        return Apiato::call('User@GetAllUsersNoLimitTask',
            [
                null
            ],
            [
                ['adminFilterSpecical' => [ $filter ] ],
                ['withColumn' => [ $selectedColumn ] ]
            ]
        );
    }
}
