<?php
/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-07-25 23:15:11
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-09-13 23:51:27
 * @ Description: Happy Coding!
 */

namespace Apiato\Core\Loaders;

use Symfony\Component\Finder\SplFileInfo;
use Illuminate\Support\Facades\Route;

trait RewriteRoutesLoaderTrait
{
    use RoutesLoaderTrait {
        runRoutesAutoLoader as public parentRunRoutesAutoLoader;
        loadApiContainerRoutes as private parentLoadApiContainerRoutes;
        loadWebContainerRoutes as parentLoadWebContainerRoutes;
        loadWebRoute as private parentLoadWebRoute;
        loadApiRoute as private parentLoadApiRoute;
        getRouteGroup as public parentGetRouteGroup;
        getApiUrl as private parentGetApiUrl;
        getApiVersionPrefix as private parentGetApiVersionPrefix;
        getMiddlewares as private parentGetMiddlewares;
        getRateLimitMiddleware as private parentGetRateLimitMiddleware;
        getRouteFileVersionFromFileName as private parentGetRouteFileVersionFromFileName;
        getRouteFileNameWithoutExtension as private parentGetRouteFileNameWithoutExtension;
    }

    /**
     * Register all the containers routes files in the framework
     */
    public function runRoutesAutoLoader()
    {
        return $this->parentRunRoutesAutoLoader();
    }

    /**
     * Register the Containers API routes files
     *
     * @param $containerPath
     * @param $containersNamespace
     */
    private function loadApiContainerRoutes($containerPath, $containersNamespace)
    {
        return $this->parentLoadApiContainerRoutes($containerPath,$containersNamespace);
    }

    /**
     * Register the Containers WEB routes files
     *
     * @param $containerPath
     * @param $containersNamespace
     */
    private function loadWebContainerRoutes($containerPath, $containersNamespace)
    {
        return $this->parentLoadWebContainerRoutes($containerPath, $containersNamespace);
    }

    /**
     * @param $file
     * @param $controllerNamespace
     */
    private function loadWebRoute($file, $controllerNamespace)
    {
        Route::group([
            'namespace'  => $controllerNamespace,
            'middleware' => ['web'],
            // 'prefix' => Apiato::call('Localization@CheckSegmentLanguageAction',['',true]),
        ], function ($router) use ($file) {
            require $file->getPathname();
        });
    }

    /**
     * @param $file
     * @param $controllerNamespace
     */
    private function loadApiRoute($file, $controllerNamespace)
    {
        return $this->parentLoadApiRoute($file, $controllerNamespace);
    }

    /**
     * @param      $endpointFileOrPrefixString
     * @param null $controllerNamespace
     *
     * @return  array
     */
    public function getRouteGroup($endpointFileOrPrefixString, $controllerNamespace = null)
    {
        // return $this->parentGetRouteGroup($endpointFileOrPrefixString, $controllerNamespace);

        $arrReturn = [
            'namespace'  => $controllerNamespace,
            'middleware' => $this->getMiddlewares(),
            // if $endpointFileOrPrefixString is a file then get the version name from the file name, else if string use that string as prefix
            'prefix'     =>  is_string($endpointFileOrPrefixString) ? $endpointFileOrPrefixString : (config('apiato.api.using_subdomain') ? '' : 'api') . $this->getApiVersionPrefix($endpointFileOrPrefixString),
        ];

        if(config('apiato.api.using_subdomain')) {
            $arrReturn['domain'] = $this->getApiUrl();
        }

        return $arrReturn;
    }

    /**
     * @return  mixed
     */
    private function getApiUrl()
    {
        return $this->parentGetApiUrl();
    }

    /**
     * @param $file
     *
     * @return  string
     */
    private function getApiVersionPrefix($file)
    {
        return $this->parentGetApiVersionPrefix($file);
    }

    /**
     * @return  array
     */
    private function getMiddlewares()
    {
        // return $this->parentGetMiddlewares();
        if(config('apiato.api.using_subdomain')) {
            return array_filter([
                'api',
                $this->getRateLimitMiddleware(), // returns NULL if feature disabled. Null will be removed form the array.
            ]);
        }

        // Nếu không dùng subdomain thì chuyển sang sử dụng các middleware tương tự với domain chính
        return array_filter([
            'web',
            'validatejson',
            'bindings',
            'profiler',
            'Maintenance',
            'throttle'
        ]);
    }

    /**
     * @return  null|string
     */
    private function getRateLimitMiddleware()
    {
        return $this->parentGetRateLimitMiddleware();
    }

    /**
     * @param $file
     *
     * @return  mixed
     */
    private function getRouteFileVersionFromFileName($file)
    {
        return $this->parentGetRouteFileVersionFromFileName($file);
    }

    /**
     * @param \Symfony\Component\Finder\SplFileInfo $file
     *
     * @return  mixed
     */
    private function getRouteFileNameWithoutExtension(SplFileInfo $file)
    {
        return $this->parentGetRouteFileNameWithoutExtension($file);
    }

}
