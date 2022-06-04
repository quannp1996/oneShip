<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-07-07 10:39:59
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-08-01 16:50:22
 * @ Description: Happy Coding!
 */

namespace App\Containers\BaseContainer\UI\WEB\Controllers\Features;

use Apiato\Core\Foundation\FunctionLib;

trait FrontBreabcrumb
{
    public function frontBreadcrumb(string $title,string $link, bool $isCurrent = false) : void
    {
        $this->breadcrumb[] = [
            'title' => ucwords($title),
            'link' => $link,
            'isCurrent' => $isCurrent
        ];
        
        \View::share('breadcrumb',$this->breadcrumb);
    }
}