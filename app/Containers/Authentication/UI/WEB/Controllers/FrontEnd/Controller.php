<?php

namespace App\Containers\Authentication\UI\WEB\Controllers\FrontEnd;

use App\Containers\Authentication\Enums\EnumGuard;

use App\Containers\Authentication\UI\API\Controllers\FrontEnd\TraitAuth;
use App\Containers\Authentication\UI\API\Controllers\FrontEnd\TraitSocial;
use App\Containers\BaseContainer\UI\WEB\Controllers\BaseFrontEndController;



/**
 * Class Controller
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class Controller extends BaseFrontEndController
{
    use TraitAuth, TraitSocial;
    public function __construct()
    {
        parent::__construct();
        $this->guard = EnumGuard::GUARD_CUSTOMER;
    }
}
