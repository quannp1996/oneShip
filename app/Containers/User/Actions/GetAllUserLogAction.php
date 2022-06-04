<?php

namespace App\Containers\User\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;

/**
 * Class GetAllUserLogAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class GetAllUserLogAction extends Action
{

    /**
     * @return mixed
     */
    public function run($filters, $limit = 10, $external_data = ['with_relationship' => ['user']])
    {
        if(!empty($filters->user_name)){
            $user = Apiato::call('User@FindUserByEmailTask',[$filters->user_name]);
            if(empty($user)){
                return $user;
            }
            $filters->user_id = $user->id;
        }

        $data = Apiato::call(
            'User@GetAllUserLogTask',
            [
                $filters,
                ['created_at' => 'desc'],
                $limit,
                $external_data
            ]
        );
        return $data;
    }
}
