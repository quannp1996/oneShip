<?php

/**
 * @ Created by: VSCode
 * @ Author: QuanNP - npquan1995@gmai.com
 * @ Create Time: 2021-08-24 21:27:54
 * @ Modified by: QuanNP - npquan1995@gmai.com
 * @ Modified time: 2021-09-20 17:05:20
 * @ Description: Happy Coding!
 */


namespace App\Containers\Authentication\UI\API\Controllers\FrontEnd;

use Apiato\Core\Foundation\Facades\Apiato;
use Apiato\Core\Foundation\FunctionLib;
use App\Containers\Authentication\Exceptions\LoginFailedException;
use App\Containers\Authentication\UI\API\Requests\FrontEnd\LoginRequest;
use App\Containers\Authentication\UI\API\Requests\FrontEnd\RegisterRequest;
use App\Ship\Parents\Controllers\WebController;
use App\Ship\Transporters\DataTransporter;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Config;

trait TraitAuth
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
            return FunctionLib::ajaxRespondV2(false, $e instanceof LoginFailedException ? 'Thông tin đăng nhập không chính xác' : $e->getMessage(), ['url' => route('get_admin_dashboard_page')], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function register(RegisterRequest $request)
    {
        dd($request->all());
    }
}
