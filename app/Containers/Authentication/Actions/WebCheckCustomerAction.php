<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-09-24 09:53:59
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-09-24 14:53:18
 * @ Description: Happy Coding!
 */


namespace App\Containers\Authentication\Actions;

use App\Containers\Authentication\Tasks\WebCheckCustomerTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;

class WebCheckCustomerAction extends Action
{
    public function run(DataTransporter $data)
    {
        $user = app(WebCheckCustomerTask::class)->run($data->username, $data->password, $data->type, $data->rememberLogin);
        return $user;
    }
}
