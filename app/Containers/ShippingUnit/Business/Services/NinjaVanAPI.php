<?php 
namespace App\Containers\ShippingUnit\Business\Services;

use App\Containers\Order\Models\Order;
use App\Containers\ShippingUnit\Business\ShippingUnitAbstract;
use App\Containers\ShippingUnit\Models\ShippingUnit;
use Illuminate\Support\Facades\Cache;

class NinjaVanAPI extends ShippingUnitAbstract
{
    const TOKENKEY = 'ninjavan_token_key';
    public $sandBoxUrl = 'https://api-sandbox.ninjavan.co/vn';
    public $liveURL = 'https://api.ninjavan.co/vn';
    protected $ninjavan_token_key;

    public function __construct(ShippingUnit $shippingUnit)
    {
        parent::__construct($shippingUnit);
        $this->liveURL = $this->devMode ? $this->sandBoxUrl : $this->liveURL;
        if(!Cache::get('ninjavan_token_key')){
            $this->login();
        }else{
            $this->ninjavan_token_key = Cache::get('ninjavan_token_key');
        }
    }   

    public function send(Order $order)
    {
        dd('send NinjaVan');
    }

    public function cancel()
    {
        dd('cancel NinjaVan');
    }
    
    public function hook()
    {

        dd('hook NinjaVan');
    }

    public function estimate(): float
    {
        return 0;
    }

    protected function login()
    {
        if(!$this->ninjavan_token_key){
            $result = $this->callApi(array_merge(
                $this->shipping->toSecurityJson(),
                ['grant_type' => 'client_credentials']
            ), 
                $this->liveURL.'/2.0/oauth/access_token'
            );
            if(!empty($result['access_token'])){
                Cache::put(self::TOKENKEY, $result['access_token']);
                $this->ninjavan_token_key = $result['access_token'];
            }
        }
        return true;
    }
}
?>