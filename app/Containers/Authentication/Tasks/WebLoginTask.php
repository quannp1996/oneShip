<?php

namespace App\Containers\Authentication\Tasks;

use App\Containers\Authentication\Exceptions\LoginFailedException;
use App\Ship\Parents\Tasks\Task;
use Auth;
use Illuminate\Contracts\Auth\Authenticatable;

class WebLoginTask extends Task
{
    /**
     * @param string $email|phone
     * @param string $password
     * @param bool   $remember
     *
     * @return Authenticatable
     * @throws LoginFailedException
     */
    public function run(string $username, string $password, $remember = false) : Authenticatable
    {
        $fieldName = filter_var( $username, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';
        $user = auth('customer')->attempt([
            $fieldName => $username,
            'password' => $password
        ], $remember);
        if(!$user) throw new LoginFailedException();
        return auth('customer')->user();
    }

}
