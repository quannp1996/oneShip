<?php 
namespace App\Containers\ShippingUnit\Business\Services;

use App\Containers\ShippingUnit\Business\ShippingUnitAbstract;

class NinjaVanAPI extends ShippingUnitAbstract
{
 
    public function send()
    {
        dd('send NinjaVan');
    }

    public function cancel()
    {
        dd('cancel NinjaVan');
    }
    public function hook(){

        dd('hook NinjaVan');
    }

    public function estimate()
    {
        
    }
    
    public function caculateShipping(): int
    {
        return 0;
    }
}
?>