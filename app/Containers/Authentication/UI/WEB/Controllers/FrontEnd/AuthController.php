<?php

namespace App\Containers\Authentication\UI\WEB\Controllers\FrontEnd;

use App\Containers\Authentication\Actions\WebLoginAction;
use App\Containers\Authentication\UI\WEB\Requests\FrontEnd\WEBLoginRequest;
use App\Containers\Authentication\UI\WEB\Requests\FrontEnd\WEBRegisterRequest;
use App\Containers\BaseContainer\UI\WEB\Controllers\BaseFrontEndController;
use App\Containers\Customer\Actions\StoreNewCustomerAction;
use App\Ship\core\Traits\HelpersTraits\ApiResTrait;
use App\Ship\Transporters\DataTransporter;

/**
 * Class AuthController
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class AuthController extends BaseFrontEndController
{
    use ApiResTrait;
    public function customerRegister(WEBRegisterRequest $request, StoreNewCustomerAction $storeNewCustomerAction)
    {
        try{
            $customer = $storeNewCustomerAction->run(new DataTransporter($request));
            if($request->ajax()){
                return $this->sendResponse([
                    'customer' => $customer
                ]);
            }
            auth('customer')->login($customer);
            return redirect()->to(route('web_dashboard_index'));
        }catch(\Exception $e){
            if($request->ajax()){
                $this->sendError();
            }
            return redirect()->back();
        }
    }

    public function customerLogin(WEBLoginRequest $request, WebLoginAction $webLoginAction){
        try{
            $webLoginAction->run(new DataTransporter($request));
            return redirect()->back();
        }catch(\Exception $e){
            return redirect()->back();
        }
    }
}
