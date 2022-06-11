<?php 
namespace App\Containers\ShippingUnit\Business;

use App\Containers\Customer\Models\Customer;
use App\Containers\Order\Models\Order;
use App\Containers\ShippingUnit\Models\ShippingUnit;
use Exception;

abstract class ShippingUnitAbstract
{
    public $shipping;
    public $devMode = false;
    public $sandBoxUrl;
    public $liveURL;
    public $customer;

    public function __construct(ShippingUnit $shippingUnit)
    {
        $this->shipping = $shippingUnit;
        // $this->devMode = $this->shipping->isDevMode();
        $this->devMode = false;
    } 

    abstract public function send(Order $order);
    abstract public function cancel();
    abstract public function hook();
    abstract public function estimate(): float;
    abstract public function caculateShipping(): int;
    
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
}
?>