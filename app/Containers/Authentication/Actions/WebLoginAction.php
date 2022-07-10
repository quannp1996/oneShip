<?php

namespace App\Containers\Authentication\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Authentication\Tasks\WebLoginTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;
use Illuminate\Contracts\Auth\Authenticatable;

class WebLoginAction extends Action
{

    /**
     * @param \App\Ship\Transporters\DataTransporter $data
     *
     * @return  \Illuminate\Contracts\Auth\Authenticatable
     */
    public function run(DataTransporter $data): Authenticatable
    {
        return app(WebLoginTask::class)->run($data->username, $data->password, $data->remember);
    }
}
