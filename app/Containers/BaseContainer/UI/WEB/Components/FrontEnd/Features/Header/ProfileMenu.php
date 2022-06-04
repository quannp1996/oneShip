<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-07-07 10:39:59
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-11-02 17:11:43
 * @ Description: Happy Coding!
 */

namespace App\Containers\BaseContainer\UI\WEB\Components\FrontEnd\Features\Header;

trait ProfileMenu
{
    public function genProfileMenu()
    {
        $this->userMenu = [
            [
                'title' => 'Đơn hàng của tôi',
                'url' => route('web_index_profile_order'),
                'icon' => 'icon-list-cart'
            ],
            [
                'title' => 'Thông báo của tôi',
                'url' => route('web_index_profile_noti'),
                'icon' => 'icon-notification'
            ],
            [
                'title' => 'Tài khoản của tôi',
                'url' => route('web_profile_index'),
                'icon' => 'icon-user-sm'
            ],
            [
                'title' => 'Nhận xét sản phẩm đã mua',
                'url' => route('web_index_profile_comment'),
                'icon' => 'icon-list-cart'
            ],
            [
                'title' => 'Yêu thích',
                'url' => route('web_index_profile_wishlist'),
                'icon' => 'icon-list-cart'
            ],
            [
                'title' => 'Mã giảm giá',
                'url' => route('web_index_profile_coupon'),
                'icon' => 'icon-list-cart'
            ],
            // [
            //     'title' => 'Thoát tài khoản',
            //     'url' => route('web_logout_customer'),
            //     'icon' => 'icon-exit'
            // ]
        ];
    }
}
