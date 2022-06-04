<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Reset Password
    |--------------------------------------------------------------------------
    |
    | Insert your allowed reset password urls to inject into the email.
    |
    */
    'allowed-reset-password-urls' => [
          'password-reset',
    ],
    
    'status' => [
        'blocked' => 3,
        'deleted' => -1,
        'actived' => 2,
        'deactived' => 1
    ]
];
