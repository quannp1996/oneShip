<?php

/**
 * @ Created by: VSCode
 * @ Author: QuanNP - npquan1995@gmai.com
 * @ Create Time: 2021-07-07 10:28:53
 * @ Modified by: QuanNP - npquan1995@gmai.com
 * @ Modified time: 2021-08-05 12:07:29
 * @ Description: Happy Coding!
 */

namespace App\Containers\BaseContainer\UI\WEB\Controllers;

use App\Containers\Settings\Actions\GetAllSettingsAction;
use App\Ship\Parents\Controllers\WebController;

class BaseAjaxController extends WebController
{
    protected $settings = [];

    public function __construct()
    {
        $this->settings = app(GetAllSettingsAction::class)->run('Array', true);
    }
}
