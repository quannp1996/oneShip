<?php

namespace App\Containers\Authentication\Tasks;

use App\Ship\Parents\Tasks\Task;
use Illuminate\Contracts\Auth\Authenticatable;
use App\Containers\Authentication\Exceptions\LoginFailedException;

class WebCheckCustomerTask extends Task
{
    public function run(string $username, string $password, $remember = true)
    {
        $fieldName = filter_var( $username, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';
        if (!$user = auth()->guard(config('auth.guard_for.frontend'))->attempt(['status' => 2, $fieldName => $username, 'password' => $password], $remember)) {
            return false;
        }

        return auth()->guard(config('auth.guard_for.frontend'))->user();
    }
}
