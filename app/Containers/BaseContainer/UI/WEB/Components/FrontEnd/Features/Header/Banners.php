<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-07-07 10:39:59
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-10-07 19:13:27
 * @ Description: Happy Coding!
 */

namespace App\Containers\BaseContainer\UI\WEB\Components\FrontEnd\Features\Header;

use App\Containers\Banner\Actions\GetAvailableBannerByPositionAction;

trait Banners
{
    public function banners(GetAvailableBannerByPositionAction $getAvailableBannerByPositionAction)
    {
        $this->topLeftBarBanners = $getAvailableBannerByPositionAction->run(
            ['top_bar_left'],
            $is_mobile = $this->isMobile,
            ['desc'],
            ['sort_order' => 'ASC'],
            $this->currentLang
        );
        $this->topRightBarBanners = $getAvailableBannerByPositionAction->run(
            ['top_bar_right'],
            $is_mobile = $this->isMobile,
            ['desc'],
            ['sort_order' => 'ASC'],
            $this->currentLang
        );
    }
}
