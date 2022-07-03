<?php

$router->any('/adminlogout', [
    'as'   => 'post_admin_logout_form',
    'uses' => 'Admin\Controller@logoutAdmin',
    'domain' => config('app.admin_url'),
]);
