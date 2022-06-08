<?php 
namespace App\Containers\FrontEnd\UI\WEB\Controllers\Auth;

use App\Containers\BaseContainer\UI\WEB\Controllers\BaseFrontEndController;

class Controller extends BaseFrontEndController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function login()
    {
        return view('frontend::auth.login');
    }
}
?>