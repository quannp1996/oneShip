<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-08-09 03:11:13
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-09-23 13:03:14
 * @ Description: Happy Coding!
 */

if (!function_exists('routeFrontEndFromOthers')) {
    /**
     * Generate the URL to a named route.
     *
     * @param  array|string  $name
     * @param  mixed  $parameters
     * @param  bool  $absolute
     * @return string
     */
    function routeFrontEndFromOthers($name, $parameters = [], $absolute = false)
    {
        $url = env('APP_URL').app('url')->route($name, $parameters, $absolute);
        return $url;
    }
}

if (!function_exists('routeFEOnlyPath')) {
    function routeFEOnlyPath($name, $parameters = [], $absolute = false)
    {
        $url = app('url')->route($name, $parameters, $absolute);
        return $url;
    }
}

if (!function_exists('routeApiFromOthers')) {

    function routeApiFromOthers($name, $parameters = [], $absolute = false)
    {
        $url = (config('apiato.api.using_subdomain') ?  env('API_URL') : '') .app('url')->route($name, $parameters, $absolute);
        return $url;
    }
}

if (!function_exists('routeAdminFromOthers')) {

    function routeAdminFromOthers($name, $parameters = [], $absolute = false)
    {
        $url = env('ADMIN_URL').app('url')->route($name, $parameters, $absolute);
        return $url;
    }
}
