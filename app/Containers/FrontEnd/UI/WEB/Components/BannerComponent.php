<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-07-27 10:41:09
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-10-07 22:39:06
 * @ Description: Happy Coding!
 */

namespace App\Containers\FrontEnd\UI\WEB\Components;

use App\Containers\Banner\Actions\GetAvailableBannerByPositionAction;
use App\Containers\BaseContainer\UI\WEB\Components\FrontEnd\BaseComponent;

class BannerComponent extends BaseComponent
{
    protected $position;
    protected $getAvailableBannerByPositionAction;
    public $banner;
    public $isMobile = false;
    protected $layouts = ['page', 'index', 'small'];
    protected $layout = '';
    public function __construct(GetAvailableBannerByPositionAction $getAvailableBannerByPositionAction, string $position, string $layout = 'index')
    {
        parent::__construct();
        $this->position = $position;
        $this->layout = $layout;
        $this->getAvailableBannerByPositionAction = $getAvailableBannerByPositionAction;
    }

    public function render()
    {
        $this->banner = $this->getAvailableBannerByPositionAction->run(
            [$this->position], 
            false, 
            [], 
            ['sort_order' => 'asc'],
            $this->currentLang,
            1
        )->first();
        if(!in_array($this->layout, $this->layouts)) $this->returnView('frontend', 'component.banner.index');
        return $this->returnView('frontend', 'component.banner.'.$this->layout);
    }
}
