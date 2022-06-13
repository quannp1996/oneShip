<?php 
namespace App\Containers\FrontEnd\UI\WEB\Controllers\Dashboard;

use App\Containers\BaseContainer\UI\WEB\Controllers\NeedAuthController;

class Order extends NeedAuthController
{
    public function orders()
    {
        view()->share('user', auth('customer')->user());
        return view('frontend::dashboard.orders');
    }
}
?>