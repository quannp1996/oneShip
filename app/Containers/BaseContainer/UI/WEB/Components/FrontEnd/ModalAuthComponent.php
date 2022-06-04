<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-07-27 12:17:15
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-10-07 19:58:44
 * @ Description: Happy Coding!
 */

namespace App\Containers\BaseContainer\UI\WEB\Components\FrontEnd;

use App\Containers\BaseContainer\UI\WEB\Components\FrontEnd\BaseComponent;

class ModalAuthComponent extends BaseComponent
{

    public function __construct()
    {
    }

    public function render()
    {
        return $this->returnView('basecontainer','components.modal-auth-component','frontend');
    }
}
