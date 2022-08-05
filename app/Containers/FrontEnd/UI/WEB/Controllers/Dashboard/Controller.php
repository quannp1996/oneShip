<?php 
namespace App\Containers\FrontEnd\UI\WEB\Controllers\Dashboard;

use App\Containers\BaseContainer\UI\WEB\Controllers\NeedAuthController;
use App\Containers\StaticPage\Actions\FrontEnd\GetAvailablePageByPositionAction;

class Controller extends NeedAuthController
{

    public function dashboard(GetAvailablePageByPositionAction $getAvailablePageByPositionAction)
    {
        // $page = $getAvailablePageByPositionAction->run(['home_introduce'], false, ['desc'], ['id' => 'desc']);
        view()->share('user', auth('customer')->user());
        return view('frontend::dashboard.dashboard');
    }

}
?>