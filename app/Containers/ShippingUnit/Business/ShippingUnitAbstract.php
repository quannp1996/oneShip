<?php 
namespace App\Containers\ShippingUnit\Business;

use App\Containers\ShippingUnit\Models\ShippingUnit;

abstract class ShippingUnitAbstract
{
    public $shipping;
    public $devMode = false;
    public $sandBoxUrl;
    public $liveURL;
    
    public function __construct(ShippingUnit $shippingUnit)
    {
        $this->shipping = $shippingUnit;
        $this->devMode = $this->shipping->isDevMode();
    } 

    abstract public function send();
    abstract public function cancel();
    abstract public function hook();
    abstract public function estimate();
    abstract public function caculateShipping(): int;
    
    public function callApi(array $callData = [], string $url)
    {
        try{
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($callData));
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
            ));
            $result = curl_exec($ch);
            curl_close($ch);
            dd($result);
            return $result;
        }catch(\Exception $e){
            dd($e->getMessage());
        }
    }
}
?>