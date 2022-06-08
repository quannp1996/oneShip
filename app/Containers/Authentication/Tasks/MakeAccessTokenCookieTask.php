<?php

namespace App\Containers\Authentication\Tasks;

use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Facades\Config;

/**
 * Class MakeAccessTokenCookieTask 
 */
class MakeAccessTokenCookieTask extends Task
{

    /**
     * @param $refreshToken
     *
     * @return  \Symfony\Component\HttpFoundation\Cookie
     */
    public function run($accessToken)
    {
        // Save the refresh token in a HttpOnly cookie to minimize the risk of XSS attacks
        $accessTokenCookie = cookie(
            'accessToken',
            $accessToken,
            Config::get('apiato.api.expires-in'),
            null,
            null,
            false,
            false, // HttpOnly
        );

        return $accessTokenCookie;
    }
}
