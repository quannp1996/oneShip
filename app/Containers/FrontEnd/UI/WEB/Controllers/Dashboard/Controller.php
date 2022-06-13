<?php 
namespace App\Containers\FrontEnd\UI\WEB\Controllers\Dashboard;

use App\Containers\BaseContainer\UI\WEB\Controllers\NeedAuthController;

class Controller extends NeedAuthController
{

    public function dashboard()
    {
        view()->share('user', auth('customer')->user());
        return view('frontend::dashboard.dashboard');
    }

}
?>