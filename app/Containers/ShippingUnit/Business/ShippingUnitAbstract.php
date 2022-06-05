<?php 
namespace App\Containers\ShippingUnit\Business;

use App\Containers\ShippingUnit\Models\ShippingUnit;

abstract class ShippingUnitAbstract
{
    public $shipping;
    public $devMode = false;

    
    public function __construct(ShippingUnit $shippingUnit)
    {
        $this->shipping = $shippingUnit;
    } 

    public function callApi()
    {

    }

    abstract public function send();
    abstract public function cancel();
    abstract public function hook();
    abstract public function estimate();
}
?>