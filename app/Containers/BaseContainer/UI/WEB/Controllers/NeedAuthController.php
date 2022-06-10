<?php

/**
 * @ Created by: VSCode
 * @ Author: QuanNP - npquan1995@gmai.com
 * @ Create Time: 2021-07-07 10:28:53
 * @ Modified by: QuanNP - npquan1995@gmai.com
 * @ Modified time: 2021-10-24 20:39:07
 * @ Description: Happy Coding!
 */

namespace App\Containers\BaseContainer\UI\WEB\Controllers;

use Illuminate\Support\Facades\View;
use App\Ship\Parents\Controllers\WebController;
use App\Ship\core\Traits\HelpersTraits\ApiResTrait;
use App\Containers\Settings\Actions\GetAllSettingsAction;


class NeedAuthController extends BaseFrontEndController
{
    use ApiResTrait;

    protected $settings = [];

    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth:customer');
    }
}
