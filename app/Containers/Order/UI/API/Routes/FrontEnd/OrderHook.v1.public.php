<?php 
    // GHTK
    $router->any('/hook/ghtk', [
        'as' => 'web_hook_ghtk',
        'uses' => 'HookController@ghtkHook'
    ]);
    // NINJA VAN
    $router->any('/hook/ninjavan', [
        'as' => 'web_hook_ninjavan',
        'uses' => 'HookController@ninjavanHook'
    ])
?>