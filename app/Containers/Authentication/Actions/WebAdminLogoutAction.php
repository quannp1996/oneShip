<?php

namespace App\Containers\Authentication\Actions;

use App\Ship\Parents\Actions\Action;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

/**
 * Class WebAdminLogoutAction.
 *
 * 
 */
class WebAdminLogoutAction extends Action
{

    /**
     * @return void
     */
    public function run(): void
    {
        $user = Auth::user();
        if($user){
            $user->update([
                'last_logout' => Carbon::now(),
                'last_active' => Carbon::now()
            ]);
        }
        Auth::guard('admin')->logout();
    }
}
