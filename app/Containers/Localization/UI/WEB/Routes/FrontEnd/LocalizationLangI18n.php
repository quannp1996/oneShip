<?php

use Apiato\Core\Foundation\Facades\Apiato;

Route::group(
    [
        'middleware' => [
            'Maintenance',
            'WebLocaleRedirect',
        ],
        'domain' => config('app.admin_url'),
        'prefix' => Apiato::call('Localization@CheckSegmentLanguageAction'),
    ],
    function ($router) {
        $router->group(
            [
                'prefix' => 'lang',
            ],
            function ($router) {
                $router->get('/i18n.ok', [
                    'as'   => 'web_localization_i18n_js',
                    'uses' => 'FrontEnd\Controller@getJsonI18n',
                ]);
            }
        );
    }
);