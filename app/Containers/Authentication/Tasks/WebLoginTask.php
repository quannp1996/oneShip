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

        if (!$user = Auth::guard('customer')->attempt([
            $fieldName => $username,
            'status' => 2,
            'password' => $password
        ],$remember)){
            throw new LoginFailedException();
        }

        return Auth::guard('customer')->user();
    }

}
