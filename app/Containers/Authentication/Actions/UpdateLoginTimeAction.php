<?php

namespace App\Containers\Authentication\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

/**
 * Class WebAdminLoginAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class UpdateLoginTimeAction extends Action
{

    /**
     * @param \App\Ship\Transporters\DataTransporter $data
     *
     */
    public function run(DataTransporter $data, $ip)
    {
        Auth::guard('admin')->user()->update([
            'last_login_ip' => $ip,
            'last_login' => Carbon::now()
        ]);
    } 
}
