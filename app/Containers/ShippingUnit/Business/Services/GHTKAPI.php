<?php

namespace App\Containers\ShippingUnit\Business\Services;

use App\Containers\ShippingUnit\Models\ShippingUnit;
use App\Containers\ShippingUnit\Business\ShippingUnitAbstract;

class GHTKAPI  extends ShippingUnitAbstract
{
    protected $api = 'https://services.giaohangtietkiem.vn';
    protected $devApi = ' https://services.ghtklab.com';
    protected $token = null;

    public function __construct(ShippingUnit $shippingUnit)
    {
        $this->shipping = $shippingUnit;
    }

    public function send()
    {
        $order = $this->covertOrder();
        $response = $this->callApi([
            "Content-Type: application/json",
            "Token: 827Fd0cfaA18d531F189A406c1e58F7A636eA5E1",
            "Content-Length: " . strlen($this->covertOrder()),
        ], $order, "https://services.ghtklab.com/services/shipment/order");
        return $response;
    }

    public function cancel()
    {
        dd('cancel GHTK');
    }
    public function hook()
    {
        dd('hook GHTK');
    }

    public function estimate(): float
    {
        return 0;
    }

    private function covertOrder()
    {
        $packages = json_decode($this->order->packages, true);
        return json_encode([
            'products' => array_map(function ($item) {
                return [
                    'name' => $item['productName'],
                    'quantity' => $item['quanlity'],
                    'product_code' => $item['productCode']
                ];
            }, $packages['list']),
            'order' => [
                'id' => $this->order->code,
                'pick_name' => $this->order->sender_fullname,
                'pick_address' => $this->order->sender_address1,
                'pick_money' => $this->order->cod,
                'pick_province' => $this->order->senderProvince->name,
                'pick_district' => $this->order->senderDistrict->name,
                'pick_ward' => $this->order->senderWard->name,
                'pick_tel' => $this->order->sender_phone,
                'pick_email' => $this->order->sender_email,
                'name' => $this->order->receiver_fullname,
                'address' => $this->order->receiver_address1,
                "province" => $this->order->receiverProvince->name,
                "district" => $this->order->receiverDistrict->name,
                "ward" => $this->order->receiverWard->name,
                'hamlet' => 'Khác',
                'tel' => $this->order->receiver_phone,
                'note' => $this->order->note,
                'value' => array_sum(array_column($packages['list'], 'price')),
                'pick_option' => 'cod',
                'total_weight' => $packages['weight']
            ]
        ]);
    }
}
