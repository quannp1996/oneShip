<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-08-10 15:16:16
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-10-02 15:47:21
 * @ Description: Happy Coding!
 */

namespace App\Ship\Exceptions\Handlers;

use Apiato\Core\Exceptions\Handlers\ExceptionsHandler as CoreExceptionsHandler;
use Apiato\Core\Foundation\Facades\Apiato;
use Apiato\Core\Foundation\Facades\FunctionLib;
use Apiato\Core\Foundation\ImageURL;
use App\Ship\core\Traits\HelpersTraits\ApiResTrait;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Response;
use Laravel\Socialite\Two\InvalidStateException;
use Throwable;

/**
 * Class ExceptionsHandler
 *
 * A.K.A (app/Exceptions/Handler.php)
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class ExceptionsHandler extends CoreExceptionsHandler
{
    use ApiResTrait;

    protected $settings = [];
    protected $isMobile = false;
    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Throwable $exception)
    {
        $this->settings = Apiato::call('Settings@GetAllSettingsAction', ['Array', true]);

        if ($this->settings['website']['mobile_active']) {
            $this->isMobile = FunctionLib::mobileDeviceDetect();
            if (is_array($this->isMobile)) {
                $this->isMobile = !empty($this->isMobile) && $this->isMobile[0];
            }
        }

        $folder = FunctionLib::appEnv();

        if ($this->isHttpException($exception)) {
            switch ($exception->getStatusCode()) {
                case 404:
                    $fullUrl = $request->fullUrl();

                    if (str_contains($fullUrl, '/' . ImageURL::DEFAULT_DIR . '/') && str_contains($fullUrl, '/' . ImageURL::DEFAULT_DIR_THUMB)) {
                        $path = $request->fullUrl();
                        $ext = @pathinfo($path)['extension'];

                        if ($ext != 'svg') {
                            $image = ImageURL::autoGenImageFromURL($path);
                            return $image->response();
                            // return redirect(url()->full());
                        }
                    }
                    if($folder == 'frontend') {
                        return response()->view('basecontainer::'.$folder.'.'.($this->isMobile ? config('basecontainer-container.mobile_alias') : config('basecontainer-container.desktop_alias')).'.404', [], 404);
                    }else {
                        return $this->sendError('notfound',Response::HTTP_NOT_FOUND,'Not found');
                    }
                case 500:
                    if ($folder == 'frontend') {
                        return response()->view('basecontainer::' . $folder . '.'.($this->isMobile ? config('basecontainer-container.mobile_alias') : config('basecontainer-container.desktop_alias')).'.500', [], 500);
                    }else {
                        throw $exception;
                    }
            }
        } elseif ($exception instanceof AuthorizationException) {
            if ($folder == 'frontend') {
                return response()->view('basecontainer::' . $folder . '.'.($this->isMobile ? config('basecontainer-container.mobile_alias') : config('basecontainer-container.desktop_alias')) . '.403', [], 403);
            }else {
                return response()->view('basecontainer::admin.403', [
                    'exception' => $exception
                ]);
            }
        } elseif ($exception instanceof ClientException || $exception instanceof InvalidStateException) {
            if ($folder == 'frontend') {
//                return response()->view('basecontainer::' . $folder . '.'.($this->isMobile ? config('basecontainer-container.mobile_alias') : config('basecontainer-container.desktop_alias')) . '.social_auth_fail', ['msg' => $exception->getMessage(), 'site_title' => 'Đăng nhập thất bại'], 400);
                return redirect()->route('web.home.index')->with(['error_action' => 'Đăng nhập thất bại']);
            }else {
                throw $exception;
            }
        }
        return parent::render($request, $exception);
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        // return response()->json(['message' => $exception->getMessage()], 401);
        return $request->expectsJson()
                    ? response()->json(['message' => $exception->getMessage()], 401)
                    : redirect()->guest($exception->redirectTo() ?? 'login');
    }
}
