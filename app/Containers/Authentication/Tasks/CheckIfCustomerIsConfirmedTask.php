<?php

namespace App\Containers\Authentication\Tasks;

use App\Containers\Authentication\Exceptions\LoginFailedException;
use App\Containers\Authentication\Exceptions\UserNotConfirmedException;
use App\Containers\User\Models\User;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class CheckIfCustomerIsConfirmedTask extends Task
{
    private $user;

    public function run()
    {
        // is the config flag set?
        if(Config::get('authentication-container.require_email_confirmation')) {

            if(! $this->user) {
                throw new LoginFailedException();
            }

            if(! $this->user->active) {
                throw new UserNotConfirmedException();
            }
        }
    }

    public function loginWithCredentials($username, $password, $field = 'email')
    {
        if(Auth::guard('customer')->attempt([$field => $username, 'password' => $password])) {
            $this->user = Auth::guard('customer')->user();
        }
        else {
            throw new LoginFailedException();
        }
    }

    public function setUser(User $user)
    {
        $this->user = $user;
    }
}
