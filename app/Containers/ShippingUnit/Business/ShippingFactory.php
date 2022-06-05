<?php 
namespace App\Containers\ShippingUnit\Business;

use App\Containers\ShippingUnit\Business\Services\GHTKAPI;
use App\Containers\ShippingUnit\Business\Services\NinjaVanAPI;
use App\Containers\ShippingUnit\Enums\EnumShipping;
use App\Containers\ShippingUnit\Models\ShippingUnit;

class ShippingFactory
{

    protected function __construct()
    {
        
    }

    static function getInstance(string $type, ShippingUnit $shippingUnit): ShippingUnitAbstract
    {
        switch($type){
            case EnumShipping::GHTK:
            default:
                return new GHTKAPI($shippingUnit);
            case EnumShipping::NINJAVAN:
                return new NinjaVanAPI($shippingUnit);
        }
    }
}
?>