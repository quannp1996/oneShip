<?php

namespace App\Containers\Customer\Tasks;

use App\Containers\Authentication\Models\PasswordReset;
use App\Containers\Customer\Models\Customer;
use App\Ship\Exceptions\InternalErrorException;
use App\Ship\Parents\Exceptions\Exception;
use App\Ship\Parents\Tasks\Task;

/**
 * Class CreatePasswordResetTask
 *
 * @author  Sebastian Weckend
 */
class CreatePasswordResetTask extends Task
{

    /**
     * @param \App\Containers\User\Models\User $user
     *
     * @return mixed
     * @throws InternalErrorException
     */
    public function run(Customer $customer)
    {
        try {
            $token = app('auth.password.broker')->createToken($customer);
            $passwordReset = PasswordReset::updateOrCreate([ 'email' => $customer->email ],
                [
                    'customer_id' => $customer->id,
                    'token' => $token,
                    'source' => config('authentication-container.token_reset.source.frontend'),
                    'pass_reset' => $this->makeNewPassRandom(8)
                ]
            );

            return $passwordReset;
        } catch (Exception $e) {
            throw new InternalErrorException();
        }
    }

    private function makeNewPassRandom($number_of_characters = 10)
    {
        $permitted_chars = '0123456789abcdefghjklmnopqyistwzABCEFGHJKLMNOPQYISTWZ';
        $input_length = strlen($permitted_chars);
        $random_string = '';

        for ($i = 0; $i < $number_of_characters; $i++) {
            $random_string .= $permitted_chars[mt_rand(0, $input_length - 1)];
        }
        return strtoupper($random_string);
    }
}
