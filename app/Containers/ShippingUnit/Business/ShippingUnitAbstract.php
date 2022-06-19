<?php 
namespace App\Containers\ShippingUnit\Business;

use App\Containers\Customer\Models\Customer;
use App\Containers\Order\Models\Order;
use App\Containers\ShippingUnit\Models\ShippingUnit;
use App\Containers\ShippingUnit\Values\DonHang;
use Exception;

abstract class ShippingUnitAbstract
{
    public $shipping;
    public $devMode = false;
    public $sandBoxUrl;
    public $liveURL;
    public $customer;
    public DonHang $donhangBase;

    public function __construct(ShippingUnit $shippingUnit)
    {
        $this->shipping = $shippingUnit;
        // $this->devMode = $this->shipping->isDevMode();
        $this->devMode = false;
    } 

    abstract public function send(Order $order);
    abstract public function cancel(Order $order);
    abstract public function hook();
    abstract public function estimate(): float;

    public function caculateShipping(): int
    {
        $pricesCustomer = json_decode($this->customer->prices, true);
        if(!empty($pricesCustomer[$this->shipping->id])){
            $constID = $pricesCustomer[$this->shipping->id]['constID'];
        }
        $servicesNotActive = $this->donhangBase->getServicesNotActive();
        if(in_array($this->shipping->id, $servicesNotActive)) throw new Exception('Địa điểm không hỗ trợ đơn vị vận chuyển'. $this->shipping->title);
        /**
         * Lấy Bảng giá được gán cho người dùng
         */
        $quotation = $this->shipping->consts->filter(function($item) use($constID){
            return $item->id == $constID;
        })->first();
        if(empty($quotation)){
            $quotation = $this->shipping->consts->filter(function($item) use($constID){
                return $item->is_default == 1;
            })->first();
        }
        $quotationCollect = collect($quotation->items);
        /**
         * Lấy đúng khung giá theo cân nặng
         */
        $extactItem = $quotationCollect->filter(function($item){
            $rangeWeight = explode('-', $item['weight']);
            return $rangeWeight[0] <= (float) $this->donhangBase->weight 
                && $this->donhangBase->weight <= (float) $rangeWeight[1];   
        })->first();

        dd($extactItem);
        
        if(empty($extactItem)) $extactItem = $quotation->items[count($quotation->items) - 1];
        
        return $extactItem['gia'][$this->donhangBase->getCondition()][$this->donhangBase->isIn()][$this->donhangBase->pich_up_method];
    }
    
    public function callApi(array $callData = [], string $url)
    {
        try{
            
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => $url,
                CURLOPT_POST => true,
                CURLOPT_HTTPHEADER => [
                    'Content-Type: application/json',
                ],
                CURLOPT_POSTFIELDS => json_encode($callData)
            ));
            $resp = curl_exec($curl);
            curl_close($curl);

            
            return json_decode($resp, true);
        }catch(\Exception $e){
        }
    }

    public function setCustomer(Customer $customer): self
    {
        $this->customer = $customer;
        return $this;
    }

    public function setDonhang(DonHang $donhang): self
    {
        $this->donhangBase = $donhang;
        return $this;
    }
}
?>