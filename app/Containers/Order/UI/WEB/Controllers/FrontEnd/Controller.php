<?php

namespace App\Containers\Order\UI\WEB\Controllers\FrontEnd;

use Apiato\Core\Traits\ResponseTrait;
use App\Containers\BaseContainer\UI\WEB\Controllers\NeedAuthController;
use App\Containers\Order\Actions\CreateOrderAction;
use App\Containers\Order\Actions\GetAllOrdersAction;
use App\Containers\Order\UI\API\Transformers\FrontEnd\OrderListCustomerTransformer;
use App\Containers\Order\UI\WEB\Requests\FrontEnd\ListOrderRequest;
use App\Containers\Order\UI\WEB\Requests\FrontEnd\StoreOrderRequest;
use App\Ship\core\Traits\HelpersTraits\ApiResTrait;

/**
 * Class Controller
 *
 * @package App\Containers\Order\UI\WEB\Controllers\FrontEnd
 */
class Controller extends NeedAuthController
{
    use ApiResTrait, ResponseTrait;
    
    public function apiList(ListOrderRequest $request, GetAllOrdersAction $getAllOrdersAction)
    {
        $orders = $getAllOrdersAction->run([
            'customerID' => auth('customer')->id(),
        ], ['shipping']);
        dd($orders);
        return $this->transform($orders, new OrderListCustomerTransformer());
    }

    public function apiStore(StoreOrderRequest $request, CreateOrderAction $createOrderAction)
    {
        $order = $createOrderAction->setData([
            'customerID' => auth('customer')->id(),
            //Sender Data
            'sender_fullname' => $request->sender['fullname'],
            'sender_phone' => $request->sender['phone'],
            'sender_email' => $request->sender['email'],
            'sender_address1' => $request->sender['address1'],
            'sender_zipcode' => $request->sender['zipcode'],
            'sender_address2' => $request->sender['address2'],
            'sender_province' => $request->sender['province'],
            'sender_district' => $request->sender['district'],
            'sender_ward' => $request->sender['ward'],
            'sender_zip' => $request->sender['zip'],
            // Receiver Data
            'receiver_fullname' => $request->receiver['fullname'],
            'receiver_phone' => $request->receiver['phone'],
            'receiver_email' => $request->receiver['email'],
            'receiver_address1' => $request->receiver['address1'],
            'receiver_zipcode' => $request->receiver['zipcode'],
            'receiver_address2' => $request->receiver['address2'],
            'receiver_province' => $request->receiver['province'],
            'receiver_district' => $request->receiver['district'],
            'receiver_ward' => $request->receiver['ward'],
            'receiver_zip' => $request->receiver['zip'],
            'cod' => $request->shipping['cod'],
            'shippingUnitID' => $request->shipping['shippingID'],
            'services' => json_encode($request->shipping['services']),
            'packages' => json_encode($request->package)
        ])->run();
        
        return $this->sendResponse([
            'order' => $order
        ]); 
    }
}