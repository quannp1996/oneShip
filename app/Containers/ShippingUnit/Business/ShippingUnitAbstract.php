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
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, '');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, []);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
        ));

        $result = curl_exec($ch);

        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if (curl_error($ch)) {
            return json_encode([
                'success' => false,
                'message' => 'created payment link failed',
                'url' => ''
            ]);
        }
        if ($status != 200) {
            curl_close($ch);
            return json_encode([
                'success' => false,
                'message' => 'created payment link failed',
                'url' => ''
            ]);
        }

        curl_close($ch);

        return $result;
    }

    abstract public function send();
    abstract public function cancel();
    abstract public function hook();
    abstract public function estimate();
}
?>