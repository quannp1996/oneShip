<?php 
namespace App\Containers\ShippingUnit\Business\Services;

use App\Containers\ShippingUnit\Business\ShippingUnitAbstract;
use App\Containers\ShippingUnit\Models\ShippingUnit;

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
        return $this->callApi();
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
        dd('estimate GHTK');
    }
    
    public function caculateShipping(): int
    {
        return 0;
    }
}
?>