<?php 
namespace App\Containers\FrontEnd\UI\WEB\Controllers\Dashboard;

use App\Containers\BaseContainer\UI\WEB\Controllers\NeedAuthController;

class Address extends NeedAuthController
{
    public function address()
    {
        view()->share('user', auth('customer')->user());
        return view('frontend::address.list');
    }
    
}
?>