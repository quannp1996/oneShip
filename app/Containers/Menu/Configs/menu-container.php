<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Menu Container
    |--------------------------------------------------------------------------
    |
    |
    |
    */
    'types' => [
        'en' => [
            '0' => 'Admin Left Menu',
            //'1' => 'Admin Top Menu',
            //'2' => 'Admin Bottom Top Menu',
            '3' => 'Public Index Header Menu',
            '4' => 'Public Index Footer Menu',
            //'5' => 'Public Other Page Footer Menu',
            //'9' => 'Other Menu',
            //'10' => 'Extension Menu',
        ],

        'vi' => [
            '0' => 'Quản trị - Menu bên phía tay trái ',
            //'1' => 'Menu trên đầu trang quản trị',
            //'2' => 'Menu phía dưới chân trang quản trị',
            '3' => 'Website - Menu chính trên đầu',
            '4' => 'Website - Menu chính dưới chân',
            //'5' => 'Menu trang khác chân website',
            //'9' => 'Menu khác',
            //'10' => 'Menu Liên kết',
        ]
    ],

    'type_key' => [
        'sidebar_admin' => 0,
        'top_admin' => 1,
        'bottom_admin' => 2,
        'top_website' => 3,
        'bottom_website' => 4,
        'extension_menu' => 10
    ],

    'status' => [
        'visible' => 1,
        'hidden' => 2,
        'old_delete' => -1
    ]
];
