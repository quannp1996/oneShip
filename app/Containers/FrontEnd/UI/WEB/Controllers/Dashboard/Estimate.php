<?php 
namespace App\Containers\FrontEnd\UI\WEB\Controllers\Dashboard;

use App\Containers\BaseContainer\UI\WEB\Controllers\NeedAuthController;

class Estimate extends NeedAuthController
{

    public function estimate()
    {
        view()->share('user', auth('customer')->user());
        return view('frontend::dashboard.estimate');
    }

}
?>