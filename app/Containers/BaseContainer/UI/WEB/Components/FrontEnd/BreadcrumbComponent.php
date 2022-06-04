<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-07-21 11:59:59
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-10-07 19:58:57
 * @ Description: Happy Coding!
 */

namespace App\Containers\BaseContainer\UI\WEB\Components\FrontEnd;

class BreadcrumbComponent extends BaseComponent
{
    public $breadcrumb;

    public function __construct(array $breadcrumb = [])
    {
        parent::__construct();
        $this->breadcrumb = $breadcrumb;
    }

    public function render()
    {
        return $this->returnView('basecontainer','components.breadcrumb-component','frontend');
    }
}
