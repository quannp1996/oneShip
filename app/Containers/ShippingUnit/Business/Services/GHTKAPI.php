<?php 
namespace App\Containers\ShippingUnit\Business\Services;

use App\Containers\ShippingUnit\Business\ShippingUnitInterface;
use App\Containers\ShippingUnit\Models\ShippingUnit;

class GHTKAPI  extends ShippingApi implements ShippingUnitInterface
{
    
    public function __construct()
    {
        parent::__construct(new ShippingUnit([]));
    }

    public function send()
    {
        dd('send GHTK');
    }

    public function cancel()
    {
        dd('cancel GHTK');
    }
    public function hook(){
        dd('hook GHTK');
    }

    public function estimate()
    {
        
    }
}
?>