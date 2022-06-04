<?php

namespace App\Containers\User\Actions;

use App\Ship\Parents\Actions\Action;
use App\Containers\User\Models\User;
use Apiato\Core\Foundation\Facades\Apiato;

class FindUserByEmailAction extends Action
{
    public function run(string $email): User
    {
        $users = Apiato::call('User@FindUserByEmailTask', [$email]) ;
        return $users;
    }
}
