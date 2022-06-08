<?php

namespace App\Containers\User\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\User\Models\User;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;

/**
 * Class DeleteUserAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class DeleteUserAction extends Action
{

    /**
     * @param \App\Ship\Transporters\DataTransporter $data
     */
    public function run(DataTransporter $data)
    {
        if(!empty($data->id)) {
            $user = Apiato::call('User@FindUserByIdTask', [$data->id]);

            if($user) {
                $result = Apiato::call('User@DeleteUserTask', [$user]);

                if($result) {
                   
                    return true;
                }
            }
        }
        return false;
    }
}
