<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-08-24 21:09:23
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-09-20 15:54:08
 * @ Description: Happy Coding!
 */

namespace App\Containers\Authentication\Actions\FrontEnd;

use App\Ship\Parents\Actions\Action;
use App\Containers\Authentication\Tasks\CreatePasswordResetTask;

class CreatePasswordResetAction extends Action
{
    
    public function run(string $email)
    {
        return app(CreatePasswordResetTask::class)->setSource(1)->run($email);
    }
}
