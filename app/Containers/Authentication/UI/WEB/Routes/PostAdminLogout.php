<?php

$router->any('/adminlogout', [
    'as'   => 'post_admin_logout_form',
    'uses' => 'Controller@logoutAdmin',
    'domain' => config('app.admin_url'),
]);
