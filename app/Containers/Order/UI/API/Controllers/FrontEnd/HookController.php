<?php

/**
 * @ Created by: VSCode
 * @ Author: QuanNP - npquan1995@gmai.com
 * @ Create Time: 2021-09-21 12:34:39
 * @ Modified by: QuanNP - npquan1995@gmai.com
 * @ Modified time: 2021-11-16 16:30:23
 * @ Description: Happy Coding!
 */

namespace App\Containers\Order\UI\API\Controllers\FrontEnd;

use Exception;
use App\Ship\core\Traits\HelpersTraits\ApiResTrait;
use App\Containers\Order\Actions\FindOrderByCodeAction;
use App\Containers\ShippingUnit\Business\Services\GHTKAPI;
use App\Containers\Customer\UI\API\Requests\GHTKHookRequest;
use App\Containers\ShippingUnit\Business\Services\NinjaVanAPI;
use App\Containers\Customer\UI\API\Requests\NinjaVanHookRequest;
use App\Containers\BaseContainer\UI\WEB\Controllers\BaseApiFrontController;

class HookController extends BaseApiFrontController
{
    use ApiResTrait;
    public function ghtkHook(GHTKHookRequest $request, FindOrderByCodeAction $findOrderByCodeAction)
    {   
        try{
            $order = $findOrderByCodeAction->run($request->partner_id, ['shipping']);
            if($order->isEmpty()) return $this->sendError('Not Found', 404, 'Đơn hàng không tồn tại');
            // Call Hook to update status order
            GHTKAPI::hook($order);
            
            return $this->sendResponse([], 'Đơn hàng đã được cập nhật', 200);
        }catch(Exception $e){
            return $this->sendError('Not Found', 303, 'Có lỗi trong quá trình xử lí '. $e->getMessage());
        }
    }

    public function ninjavanHook(NinjaVanHookRequest $request, FindOrderByCodeAction $findOrderByCodeAction)
    {
        try{
            $order = $findOrderByCodeAction->run($request->partner_id, ['shipping']);
            if($order->isEmpty()) return $this->sendError('Not Found', 404, 'Đơn hàng không tồn tại');
            NinjaVanAPI::hook($order);
            return $this->sendResponse([], 'Đơn hàng đã được cập nhật', 200);
        }catch(Exception $e){
            return $this->sendError('Not Found', 303, 'Có lỗi trong quá trình xử lí '. $e->getMessage());
        }
    }
}
