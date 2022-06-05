<?php 
namespace App\Containers\ShippingUnit\Business\Services;

use App\Containers\ShippingUnit\Models\ShippingUnit;

class ShippingApi
{
    public $shipping;
    public $devMode = false;
    public function __construct(ShippingUnit $shipping)
    {
        $this->shipping = $shipping;
    }  

    public function callApi()
    {

    }
}
?>