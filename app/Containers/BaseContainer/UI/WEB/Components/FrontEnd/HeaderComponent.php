<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-07-21 11:59:59
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-10-07 19:58:35
 * @ Description: Happy Coding!
 */

namespace App\Containers\BaseContainer\UI\WEB\Components\FrontEnd;

use Apiato\Core\Foundation\Facades\Apiato;
use Illuminate\Database\Eloquent\Collection;

class HeaderComponent extends BaseComponent
{
    public $menus, $headerMenus, $class, $promotionTop;

    public function __construct(Collection $menus, $class = 'home')
    {
        parent::__construct();
        $this->class = $class;
        $this->menus = $menus;
    }

    public function render()
    {
        $this->headerMenus = $this->menus->filter(function ($item) {
            return $item->type == config('menu-container.type_key.top_website');
        })->groupBy('pid');

        $this->promotionTop = Apiato::call('Banner@GetAvailableBannerByPositionAction', [
            ['top_text'], $this->isMobile, [], ['sort_order' => 'ASC', 'id' => 'DESC'], $this->currentLang, 0
        ])->first();

        return $this->returnView('basecontainer', 'components.header-component', 'frontend', [
            'class' => request()->route()->getName() == 'home' ? 'header-fixed header-home' : ''
        ]);
    }
}
