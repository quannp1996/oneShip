<?php

namespace App\Containers\Authentication\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Authentication\Data\Transporters\ProxyApiLoginTransporter;
use App\Ship\Parents\Actions\Action;

class ProxyApiLoginAction extends Action
{
    public function run(array $data): array
    {
        $loginCustomAttribute = Apiato::call('Authentication@ExtractLoginCustomAttributeTask', [$data]);

        $requestData = [
            'username'      => $loginCustomAttribute['username'],
            'password'      => $data['password'],
            'grant_type'    => $data['grant_type'] ?? 'password',
            'client_id'     => $data['client_id'],
            'client_secret' => $data['client_password'],
            'scope'         => $data['scope'] ?? '',
        ];

        $responseContent = Apiato::call('Authentication@CallOAuthServerTask', [$requestData]);
        // dd($responseContent);
        // check if user email is confirmed only if that feature is enabled.
        Apiato::call('Authentication@CheckIfAdminIsConfirmedTask', [],
            [['loginWithCredentials' => [
                $requestData['username'], $requestData['password'], $loginCustomAttribute['loginAttribute']]]
            ]);

        $refreshCookie = Apiato::call('Authentication@MakeRefreshCookieTask', [$responseContent['refresh_token']]);
        // $accessTokenCookie = Apiato::call('Authentication@MakeAccessTokenCookieTask', [$responseContent['access_token']]);
// dd($accessTokenCookie);
        return [
            'response_content' => $responseContent,
            'refresh_cookie'   => $refreshCookie,
            // 'access_token_cookie' => $accessTokenCookie
        ];
    }
}
