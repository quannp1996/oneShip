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
        $url = $this->api.'/services/shipment/order';
        $result = $this->callApi(
            array_merge(['Content-Type' => 'application/json'], $this->shipping->toSecurityJson()), 
            $this->covertOrder(),
            $url
        );
        dd($result);
    }

    public function cancel()
    {
        dd('cancel GHTK');
    }
    public function hook(){
        dd('hook GHTK');
    }

    public function estimate(): float
    {
        return 0;
    }

    private function covertOrder(): array
    {
        dd($this->order);
        $packages = json_decode($this->order->packages, true);
        return [
            'products' => array_map(function($item){
                return [
                    'name' => $item['productName'],
                    'quantity' => $item['quanlity'],
                    'product_code' 
                ];
            }, $packages['list']),
            'order' => [
                'id' => $this->order->code,
                'pick_name' => $this->order->sender_fullname,
                'pick_address' => $this->order->sender_address1,
                'pick_money' => $this->order->cod,
                'pick_province' => '',
                'pick_district' => '',
                'pick_ward' => '',
                'pick_tel' => $this->order->sender_phone,
                'pick_email' => $this->order->sender_email,
            ]
        ];
    }
}
?>