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

    'device' => [
        '0' => 'PC',
        '1' => 'Mobile'
    ],

    'user_status_removed' => -1,
    'user_status_banned' => 0,
    'user_status_pending' => 1,
    'user_status_actived' => 2,
    'user_status_not_login' => 3,
    'user_status_offline' => 4,
    'user_status_online' => 5,

    'status-text' => [
        -1 => 'Đã xóa',
        0 => 'Bị khóa',
        1 => 'Chưa kích hoạt',
        2 => 'Đã kích hoạt',
        3 => 'Chưa hoạt động',
        4 => 'Offline',
        5 => 'Online',
    ]
];
