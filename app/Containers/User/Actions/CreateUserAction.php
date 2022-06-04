<?php

namespace App\Containers\User\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\User\Models\User;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;

/**
 * Class CreateUserAction.
 */
class CreateUserAction extends Action
{

    /**
     * @param \App\Ship\Transporters\DataTransporter $data
     *
     * @return  \App\Containers\User\Models\User
     */
    public function run(DataTransporter $data): User
    {
        $admin = Apiato::call('User@CreateUserByCredentialsTask', [
            $isClient = false,
            $data->email,
            $data->password,
            $data->name,
            $data->phone
        ]);

        return $admin;
    }
}
