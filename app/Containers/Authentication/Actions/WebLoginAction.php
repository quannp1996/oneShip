<?php

namespace App\Containers\Authentication\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;
use Illuminate\Contracts\Auth\Authenticatable;

class WebLoginAction extends Action
{

    /**
     * @param \App\Ship\Transporters\DataTransporter $data
     *
     * @return  \Illuminate\Contracts\Auth\Authenticatable
     */
    public function run(DataTransporter $data): Authenticatable
    {
        $user = Apiato::call('Authentication@WebLoginTask', [$data->username, $data->password, $data->remember]);

        Apiato::call('Authentication@CheckIfCustomerIsConfirmedTask', [], [['setUser' => [$user]]]);

        return $user;
    }
}
