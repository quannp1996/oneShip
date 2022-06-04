<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-08-24 21:27:54
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-09-20 17:05:20
 * @ Description: Happy Coding!
 */


namespace App\Containers\Authentication\UI\API\Controllers\FrontEnd;

use Apiato\Core\Foundation\Facades\Apiato;
use Apiato\Core\Foundation\FunctionLib;
use App\Containers\Authentication\Exceptions\LoginFailedException;
use App\Containers\Authentication\UI\API\Requests\FrontEnd\LoginRequest;
use App\Ship\Parents\Controllers\WebController;
use App\Ship\Transporters\DataTransporter;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Config;

class AuthController extends WebController
{
    public function login(LoginRequest $request)
    {
        try {
            $result = Apiato::call('Authentication@WebAdminLoginAction', [new DataTransporter($request)]);
            if (!is_array($result)) {
                $redirectURL = !empty($request->previous_url) ? $request->previous_url : route('get_admin_dashboard_page');
                $dataLogin = array_merge($request->all(), [
                    'client_id'       => Config::get('authentication-container.clients.web.admin.id'),
                    'client_password' => Config::get('authentication-container.clients.web.admin.secret')
                ]);
                $content = Apiato::call('Authentication@ProxyApiLoginAction', [$dataLogin]);
                if ($content) {
                    Apiato::call('Authentication@UpdateLoginTimeAction', [new DataTransporter($request), $request->ip()]);
                }
                return FunctionLib::ajaxRespondV2(true, 'success', ['token' => $content, 'url' => $redirectURL]);
            }
        } catch (Exception $e) {
            throw $e;
            return FunctionLib::ajaxRespondV2(false, $e instanceof LoginFailedException ? 'Thông tin đăng nhập không chính xác' : $e->getMessage(), ['url' => route('get_admin_dashboard_page')], Response::HTTP_UNAUTHORIZED);
            // return redirect('login')->with('status', $e instanceof LoginFailedException ? 'Thông tin đăng nhập không chính xác' : $e->getMessage());
        }

        // return is_array($result) ? redirect('login')->with($result) : redirect()->route('get_admin_dashboard_page')->withCookie($content['refresh_cookie'])->withCookie($content['access_token_cookie']);
    }
}
