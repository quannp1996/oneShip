<?php

return [
    'admin' => [
        'name' => "BigCore Admin UI",
        'css' => [
            'admin/css/jquery-ui.min.css',
            'admin/css/style.css',
            // Media
            'admin/css/font-awesome.min.css',
            'admin/css/jquery.datetimepicker.min.css',
            'admin/css/nprogress.css',
            // CSS
            'admin/css/select2.min.css',
            'admin/css/customize.css',
            'admin/css/custom.css',
            'admin/css/dropify.min.css', // Upload and Preview Image
        ],
        'js' => [
            'admin/js/library/jquery-3.5.1.min.js',
            'admin/vendors/@coreui/coreui/js/coreui.bundle.min.js',
            'admin/vendors/@coreui/coreui/js/coreui.bundle.min.map',
            'admin/js/library/jquery-ui.min.js',
            'admin/js/library/jquery.datetimepicker.min.js',
            'admin/js/library/select2.min.js',
            'admin/js/library/sweetalert2@10.js',
            'admin/js/library/nprogress.min.js',
            'admin/js/library/dropify.min.js',
            'admin/js/library/jquery.i18n.min.js',
            'admin/js/library/jquery.i18n.messagestore.min.js',
            'js/core.js',
            'admin/js/tooltips.js',
            'admin/js/helpers.js',
            'admin/js/admin.js',
            'admin/js/lang.js',
            'admin/js/init/ajax-setup.js',
            'admin/js/init/sidebar-setup.js',
            'admin/js/init/plugin-setup.js',
            'admin/js/init/submit-setup.js',
            'admin/js/customize.js',
            'admin/js/customer.js',
            'admin/js/customer-group.js',
            'admin/js/order.js',
            'admin/js/comment.js',
            'admin/js/discount.js',
            'admin/js/discount-list.js',
            'admin/js/iframe.js',
        ],
        'media' => [
            'admin/node_modules/font-awesome/css/font-awesome.min.css',
            'admin/css/jquery.datetimepicker.min.css'
        ],
        'favicon' => 'template/images/logo.png'
    ],
    'web' => [
        'name' => "Website",
        'css' => [
            'template/libs/bootstrap/bootstrap.min.css',
            'template/libs/swiper/swiper-bundle.min.css',
            'template/css/style.css',
        ],
        'js' => [
            'template/js/httpvueloader.js',
            config('app.env') == 'local' ? 'template/js/vue_dev.js' : 'template/js/vue.js',
            'template/libs/jquery/jquery.min.js',
            'template/libs/bootstrap/bootstrap.min.js',
            'template/libs/swiper/swiper-bundle.min.js',
            'js/sweetalert2.all.min.js',
            'js/URLSearchParams.js',
            'js/lodash.min.js',
            'js/core.js',
            'template/js/main.js',
            'js/global.js',
        ],
        'media' => [],
        'override' => [
            'css' => [
            ],
            'js' => [
            ]
        ],
        'favicon' => 'template/images/logo.png'
    ],
    'mobile' => [
        'name' => "Mobile",
        'css' => [
        ],
        'js' => [
        ],
        'media' => [],
        'override' => [
            'css' => [],
            'js' => []
        ],
        'favicon' => 'template/images/logo.png'
    ],
    'mobile_alias' => 'mobile',
    'desktop_alias' => 'pc'
];
