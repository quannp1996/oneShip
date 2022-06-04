<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-07-07 10:39:59
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-10-07 19:13:33
 * @ Description: Happy Coding!
 */

namespace App\Containers\BaseContainer\UI\WEB\Components\FrontEnd\Features\Header;

trait Menus
{
    public function menus()
    {
        $this->headerMenus = $this->menus->filter(function ($item) {
            return $item->type == config('menu-container.type_key.top_website');
        });

        $this->extensionMenus = $this->menus->filter(function ($item) {
            return $item->type == config('menu-container.type_key.extension_menu');
        });
    }
}
