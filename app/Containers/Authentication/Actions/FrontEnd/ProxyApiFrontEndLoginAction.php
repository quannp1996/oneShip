<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-08-24 21:09:23
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-09-20 15:54:08
 * @ Description: Happy Coding!
 */

namespace App\Containers\Authentication\Actions\FrontEnd;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;

class ProxyApiFrontEndLoginAction extends Action
{

    public function run(array $data, bool $isSocial): array
    {
        $loginCustomAttribute = Apiato::call('Authentication@ExtractLoginCustomAttributeTask', [$data]);

        $requestData = [
            'username'      => $loginCustomAttribute['username'],
            'password'      => @$data['password'],
            'grant_type'    => @$data['grant_type'] ? $data['grant_type'] : 'password',
            'client_id'     => @$data['client_id'],
            'client_secret' => @$data['client_password'],
            'scope'         => @$data['scope'] ? $data['scope'] : '',
        ];

        $responseContent = Apiato::call('Authentication@CallOAuthServerTask', [$requestData]);

        if(!$isSocial) {
            // check if user email is confirmed only if that feature is enabled.
            Apiato::call(
                'Authentication@CheckIfCustomerIsConfirmedTask',
                [],
                [
                    ['loginWithCredentials' => [
                        $requestData['username'], $requestData['password'], $loginCustomAttribute['loginAttribute']
                    ]]
                ]
            );
        }
        // $refreshCookie = Apiato::call('Authentication@MakeRefreshCookieTask', [$responseContent['refresh_token']]);

        return $responseContent;
        // return [
        //     'response_content' => $responseContent,
        //     'refresh_cookie'   => $refreshCookie,
        //     // 'access_token_cookie' => $accessTokenCookie
        // ];
    }
}
