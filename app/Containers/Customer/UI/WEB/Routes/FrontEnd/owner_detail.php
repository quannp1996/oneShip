<?php 
Route::group(
    [
        'prefix' => 'owners',
        'namespace' => '\App\Containers\Customer\UI\WEB\Controllers\Desktop',
        'domain' => parse_url(config('app.url'))['host'],
    ],
    function($router){

        $router->get('/{safe_title}-{owner_id}', [
            'as' => 'owners.get_owner_detail_page',
            'uses' => 'CustomerProfileController@showDetailCustomer',
        ])->where([
            'safe_title' => '[a-zA-Z0-9_\-]+',
            'id' => '[0-9]+'
        ]);

        $router->post('/toggle_follow', [
            'as' => 'owners.toggle_follow_owner',
            'uses' => 'CustomerProfileController@toggleFollow',
            'middleware' => ['auth:customer']
        ])->where([
            'safe_title' => '[a-zA-Z0-9_\-]+',
            'id' => '[0-9]+'
        ]);
    }
);
?>