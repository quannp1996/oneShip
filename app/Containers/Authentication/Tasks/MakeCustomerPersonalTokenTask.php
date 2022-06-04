<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-09-08 20:38:03
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-09-08 20:53:10
 * @ Description: Happy Coding!
 */

namespace App\Containers\Authentication\Tasks;

use App\Ship\Parents\Tasks\Task;
use Carbon\Carbon;
use Illuminate\Support\Facades\Config;

class MakeCustomerPersonalTokenTask extends Task
{
    public function run($user,bool $remember = false)
    {
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($remember) {
            $token->expires_at = Carbon::now()->addWeeks(2);
        }else {
            $token->expires_at = Carbon::now()->addDays(1);
        }
        $token->save();
        return [
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ];
    }
}
