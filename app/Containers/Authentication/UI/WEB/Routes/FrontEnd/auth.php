<?php
$router->POST('/social_login', [
    'as'   => 'web_social_login',
    'uses'       => 'FrontEnd\Controller@loginSocial',
    'domain' => config('app.url'),
]);