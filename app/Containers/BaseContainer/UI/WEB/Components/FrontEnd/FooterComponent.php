<?php

namespace App\Containers\BaseContainer\UI\WEB\Components\FrontEnd;

use Illuminate\Database\Eloquent\Collection;

class FooterComponent extends BaseComponent
{
    public $footerMenus;

    public function __construct(Collection $menus)
    {
        $this->footerMenus = $menus;
    }

    public function render()
    {
        $this->footerMenus = $this->footerMenus->filter(function ($item) {
            return $item->type == config('menu-container.type_key.bottom_website');
        })->groupBy('pid');

        return $this->returnView('basecontainer', 'components.footer-component', 'frontend');
    }
}
