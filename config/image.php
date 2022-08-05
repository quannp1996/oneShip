<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Image Driver
    |--------------------------------------------------------------------------
    |
    | Intervention Image supports "GD Library" and "Imagick" to process images
    | internally. You may choose one of them according to your PHP
    | configuration. By default PHP's "GD Library" implementation is used.
    |
    | Supported: "gd", "imagick"
    |
    */

    'driver' => 'gd',
    'defaultImg' => [
        'max' => ['with' => 1500, 'height' => 1500], //for validate
        'size' => [
            'original' => ['width' => 0, 'height' => 0],
            'small' => ['width' => 80, 'height' => 0],
            'medium' => ['width' => 250, 'height' => 0],
            'large' => ['width' => 800, 'height' => 0],
        ]
    ],
    'data' => [
        'menu' => [
            'max' => ['with' => 845, 'height' => 845], //for validate
            'size' => [
                'original' => ['width' => 0, 'height' => 0],
                'small' => ['width' => 250, 'height' => 0],
                'seo' => ['width' => 800, 'height' => 800],
                'social' => ['width' => 880, 'height' => 0],
            ]
        ],
        'news' => [
            'size' => [
                'medium' => ['width' => 200, 'height' => 0],
                'medium1' => ['width' => 167, 'height' => 140],
                'medium2' => ['width' => 360, 'height' => 0],
                'medium3' => ['width' => 300, 'height' => 0],
                'medium4' => ['width' => 400, 'height' => 0],
                'medium5' => ['width' => 407, 'height' => 385],
                'large' => ['width' => 570, 'height' => 0],
                'detail' => ['width' => 920, 'height' => 0],
                'social' => ['width' => 800, 'height' => 0],
                'social1' => ['width' => 1042, 'height' => 752],
                'social2' => ['width' => 843, 'height' => 459],
                '1542x1030' => ['width' => 1542, 'height' => 1030],
                '758x506' => ['width' => 758, 'height' => 506],
            ]
        ],
        'staticpage' => [
            'size' => [
                'original' => ['width' => 0, 'height' => 0],
                'small' => ['width' => 100, 'height' => 0],
                'medium' => ['width' => 238, 'height' => 0],
                'medium2' => ['width' => 350, 'height' => 0],
                'large' => ['width' => 570, 'height' => 0],
                'detail' => ['width' => 920, 'height' => 0],
                'social' => ['width' => 800, 'height' => 0],
                'large1' => ['width' => 941, 'height' => 0],
                'largex2' => ['width' => 1530, 'height' => 979],
                'largex3' => ['width' => 1531, 'height' => 979],
                'largex4' => ['width' => 1920, 'height' => 1000],
            ]
        ],
        'product' => [
            'size' => [
                'small' => ['width' => 80, 'height' => 0],
                'medium' => ['width' => 285, 'height' => 0],
                'mediumx1' => ['width' => 370, 'height' => 248],
                'mediumx2' => ['width' => 350, 'height' => 0],
                'mediumx3' => ['width' => 300, 'height' => 0],
                'mediumx4' => ['width' => 500, 'height' => 0],
                'large' => ['width' => 940, 'height' => 525],
                'largex2' => ['width' => 1300, 'height' => 0],
                '690x458' => ['width' => 690, 'height' => 458],
                'social' => ['width' => 950, 'height' => 0],
            ]
        ],
        'setting' => [
            'max' => ['with' => 845, 'height' => 845], //for validate
            'size' => [
                'original' => ['width' => 0, 'height' => 0],
                'logo' => ['width' => 0, 'height' => 0],
                'medium_seo' => ['width' => 250, 'height' => 0],
                'seo' => ['width' => 800, 'height' => 800],
                'social' => ['width' => 800, 'height' => 0],
            ]
        ],
        'file' => [],
        'gallery' => [
            'dir' => 'gallery',
            'size' => [
                'original' => ['width' => 0, 'height' => 0],
                'small' => ['width' => 150, 'height' => 0],
                'slide' => ['width' => 350, 'height' => 0],
                'large' => ['width' => 640, 'height' => 0],
                'social' => ['width' => 800, 'height' => 0],
            ]
        ],
        'customer' => [
            'size' => [
                'original' => ['width' => 0, 'height' => 0],
                'tiny' => ['width' => 13, 'height' => 0],
                'small' => ['width' => 45, 'height' => 0],
                'avatar' => ['width' => 400, 'height' => 0],
                'social' => ['width' => 800, 'height' => 0],
            ]
        ],
        'order' => [
            'size' => [
                'original' => ['width' => 0, 'height' => 0],
                'address_img' => ['width' => 800, 'height' => 0],
                'social' => ['width' => 800, 'height' => 0],
            ]
        ],
        'shipping' => [
            'size' => [
                'original' => ['width' => 0, 'height' => 0],
                'address_img' => ['width' => 800, 'height' => 0],
                'social' => ['width' => 800, 'height' => 0],
            ]
        ],
    ]

];
