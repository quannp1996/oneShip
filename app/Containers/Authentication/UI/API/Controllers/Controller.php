<?php

namespace App\Containers\Authentication\UI\API\Controllers;

use Apiato\Core\Foundation\Facades\Apiato;
use Apiato\Core\Foundation\StringLib;
use App\Containers\Authentication\Data\Transporters\ProxyApiLoginTransporter;
use App\Containers\Authentication\Data\Transporters\ProxyRefreshTransporter;
use App\Containers\Authentication\UI\API\Requests\LoginRequest;
use App\Containers\Authentication\UI\API\Requests\LoginSocialRequest;
use App\Containers\Authentication\UI\API\Requests\LogoutCustomerRequest;
use App\Containers\Authentication\UI\API\Requests\LogoutRequest;
use App\Containers\Authentication\UI\API\Requests\RefreshRequest;
use App\Containers\Customer\Actions\FindOneCustomerByCondiationAction;
use App\Containers\Customer\Actions\StoreNewCustomerAction;
use App\Ship\core\Traits\HelpersTraits\ApiResTrait;
use App\Ship\Parents\Controllers\ApiController;
use App\Ship\Transporters\DataTransporter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cookie;

/**
 * Class Controller
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class Controller extends ApiController
{
    /**
     * @param \App\Containers\Authentication\UI\API\Requests\LogoutRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(LogoutRequest $request)
    {
        $dataTransporter = new DataTransporter($request);
        $dataTransporter->bearerToken = $request->bearerToken();

        Apiato::call('Authentication@ApiLogoutAction', [$dataTransporter]);

        return $this->accepted([
            'message' => 'Token revoked successfully.',
        ])->withCookie(Cookie::forget('refreshToken'));
    }

    public function logoutCustomer(LogoutCustomerRequest $request)
    {
        $dataTransporter = new DataTransporter($request);
        $dataTransporter->bearerToken = $request->bearerToken();

        Apiato::call('Authentication@ApiLogoutAction', [$dataTransporter]);

        return $this->accepted([
            'message' => 'Token revoked successfully.',
        ])->withCookie(Cookie::forget('refreshToken'));
    }

    /**
     * This `proxyLoginForAdminWebClient` exist only because we have `AdminWebClient`
     * The more clients (Web Apps). Each client you add in the future, must have
     * similar functions here, with custom route for dedicated for each client
     * to be used as proxy when contacting the OAuth server.
     * This is only to help the Web Apps (JavaScript clients) hide
     * their ID's and Secrets when contacting the OAuth server and obtain Tokens.
     *
     * @param \App\Containers\Authentication\UI\API\Requests\LoginRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function proxyLoginForAdminWebClient(LoginRequest $request)
    {
        $dataLogin = array_merge($request->all(), [
            'client_id'       => Config::get('authentication-container.clients.web.admin.id'),
            'client_password' => Config::get('authentication-container.clients.web.admin.secret')
        ]);

        $result = Apiato::call('Authentication@ProxyApiLoginAction', [$dataLogin]);

        return $this->json($result['response_content'])->withCookie($result['refresh_cookie']);
    }

    /**
     * Read the comment in the function `proxyLoginForAdminWebClient`
     *
     * @param \App\Containers\Authentication\UI\API\Requests\RefreshRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function proxyRefreshForAdminWebClient(RefreshRequest $request)
    {
        $dataTransporter = new ProxyRefreshTransporter(
            array_merge($request->all(), [
                'client_id'       => Config::get('authentication-container.clients.web.admin.id'),
                'client_password' => Config::get('authentication-container.clients.web.admin.secret'),
                'refresh_token'   => $request->refresh_token ?: $request->cookie('refreshToken'),
            ])
        );

        $result = Apiato::call('Authentication@ProxyApiRefreshAction', [$dataTransporter]);

        return $this->json($result['response-content'])->withCookie($result['refresh-cookie']);
    }

    public function loginSocial(LoginSocialRequest $request, FindOneCustomerByCondiationAction $findOneCustomerByCondiationAction)
    {
        try{
            $user = $findOneCustomerByCondiationAction->run([
                'social_id' => $request->social_id,
                'social_provider' => $request->social_provider
            ]);

            if(!$user){
                $data = new DataTransporter([
                    'social_id' => $request->social_id,
                    'social_provider' => 'facebook',
                    'fullname' => $request->social_name,
                    'email' => sprintf('%sfacebook@gmail.com', $request->social_id),
                    'password' => StringLib::random(8),
                    'status' => 2
                ]);
                $user = app(StoreNewCustomerAction::class)->run($data);
            }

            if($user->status != 2) return $this->sendError('unauthorzie', '404', 'Tài khoản không được kích hoạt');

            $token = auth('api')->login($user, true);
            
            return $this->sendResponse([
                'success' => true,
                'access_token' => $token
            ]);

        }catch(\Exception $e){
            return $this->sendError('unauthorize', 404, $e->getMessage());
        }
    }
}
