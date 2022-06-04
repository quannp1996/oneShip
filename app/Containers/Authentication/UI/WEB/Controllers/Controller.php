<?php

namespace App\Containers\Authentication\UI\WEB\Controllers;

use Apiato\Core\Foundation\Facades\Apiato;
use Apiato\Core\Foundation\FunctionLib;
use Illuminate\Support\Str;
use App\Containers\Authentication\Data\Transporters\ProxyApiLoginTransporter;
use App\Containers\Authentication\Exceptions\LoginFailedException;
use App\Containers\Authentication\Models\PasswordReset;
use App\Containers\Authentication\UI\WEB\Requests\Admin\LoginRequest;
use App\Containers\Authentication\UI\WEB\Requests\Admin\LogoutRequest;
use App\Containers\Authentication\UI\WEB\Requests\Admin\ResetPasswordFormRequest;
use App\Containers\Authentication\UI\WEB\Requests\Admin\SendLinkResetRequest;
use App\Containers\Authentication\UI\WEB\Requests\ViewDashboardRequest;
use App\Containers\FrontEnd\UI\WEB\Requests\Auth\SubmitPasswordUpdateRequest;
use App\Containers\Authentication\Events\Admin\Events\ForgotPasswordEvent;
use App\Containers\User\Models\User;
use App\Ship\Parents\Controllers\WebController;
use App\Ship\Transporters\DataTransporter;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

/**
 * Class Controller
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class Controller extends WebController
{

    /**
     * @return  \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLoginPage()
    {
        return view('authentication::admin.login');
    }

    /**
     * @return  \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logoutAdmin(LogoutRequest $request)
    {
        Apiato::call('Authentication@WebAdminLogoutAction');

        return redirect('login');
    }

    /**
     * @param \App\Containers\Authentication\UI\WEB\Requests\LoginRequest $request
     *
     * @return  \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function loginAdmin(LoginRequest $request)
    {
        try {
            $result = Apiato::call('Authentication@WebAdminLoginAction', [new DataTransporter($request)]);
            $redirectURL = !empty($request->previous_url) ? $request->previous_url : route('get_admin_dashboard_page');
            return FunctionLib::ajaxRespondV2(true, 'success', ['url' => $redirectURL]);
            // if (!is_array($result)) {
            //     $redirectURL = !empty($request->previous_url) ? $request->previous_url : route('get_admin_dashboard_page');
            //     $datalogin =  array_merge($request->all(), [
            //         'client_id'       => Config::get('authentication-container.clients.web.admin.id'),
            //         'client_password' => Config::get('authentication-container.clients.web.admin.secret')
            //     ]);
            //     $content = Apiato::call('Authentication@ProxyApiLoginAction', [$datalogin]);
            //     if ($content) {
            //         Apiato::call('Authentication@UpdateLoginTimeAction', [new DataTransporter($request), $request->ip()]);
            //     }
            //     return FunctionLib::ajaxRespondV2(true, 'success', ['token' => $content, 'url' => $redirectURL]);
            // }
        } catch (Exception $e) {
            return FunctionLib::ajaxRespondV2(false, $e instanceof LoginFailedException ? 'Thông tin đăng nhập không chính xác' : $e->getMessage(), ['url' => route('get_admin_dashboard_page')], Response::HTTP_UNAUTHORIZED);
            // return redirect('login')->with('status', $e instanceof LoginFailedException ? 'Thông tin đăng nhập không chính xác' : $e->getMessage());
        }

        // return is_array($result) ? redirect('login')->with($result) : redirect()->route('get_admin_dashboard_page')->withCookie($content['refresh_cookie'])->withCookie($content['access_token_cookie']);
    }

    /**
     * @param \App\Containers\Authentication\UI\WEB\Requests\Admin\SendLinkResetRequest $request
     */
    public function sendResetLink(SendLinkResetRequest $request)
    {
        try {
            $token = Str::random(config('authentication-container.token_reset.length'));
            $passwordReset = PasswordReset::updateOrCreate([ 'email' => $request->email2 ],
                [
                    'token' => $token,
                ]
            );
            ForgotPasswordEvent::dispatch($passwordReset, User::where([
                'email' => $request->email2
            ])->first());
            return FunctionLib::ajaxRespondV2(true, 'success', []);
        } catch (Exception $e) {
            return FunctionLib::ajaxRespondV2(false, 'success', [$e->getMessage()]);
        }
    }

    /**
     * @param \App\Containers\Authentication\UI\WEB\Requests\Admin\SendLinkResetRequest $request
     */
    public function resetPasswordForm(ResetPasswordFormRequest $request){
        try{
            $passwordReset = PasswordReset::where([
                'token' => decrypt($request->token),
                'email' => $request->email,
            ])->first();
            if(!$passwordReset) abort(404);
            if (Carbon::parse($passwordReset->updated_at)->addSeconds(config('authentication-container.token_reset.time'))->isPast()) {
                $passwordReset->delete();
                abort(404);
            }
            return view('authentication::admin.reset', [
                'request' => $request
            ]);
        }catch(\Exception $e){
            abort(404);
        }

    }

    /**
     * @param \App\Containers\Authentication\UI\WEB\Requests\Admin\SendLinkResetRequest $request
     */
    // public function updatePassword(SubmitPasswordUpdateRequest $request){
    //     try{
    //         $passwordReset = PasswordReset::where([
    //             'token' => decrypt($request->token),
    //             'email' => $request->email,
    //         ])->firstOrFail();
    //         DB::beginTransaction();
    //         $user = Apiato::call('User@FindUserByEmailAction', [$request->email]);
    //         Apiato::call('User@UpdateUserAction', [ new DataTransporter([
    //             'id' => $user->id,
    //             'password' => $request->password
    //         ])]);
    //         $passwordReset->delete();
    //         DB::commit();
    //         return FunctionLib::ajaxRespondV2(true, 'Thay đổi mật khẩu thành công', []);
    //     }catch(\Exception $e){
    //         DB::rollBack();
    //         return FunctionLib::ajaxRespondV2(false, 'Thay đổi mật khẩu không thành công '. $e->getMessage(), [$e->getMessage()]);
    //     }
    // }
}
