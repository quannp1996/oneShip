<?php 
namespace App\Containers\ShippingUnit\Business\Services;

use App\Containers\ShippingUnit\Business\ShippingUnitAbstract;
use App\Containers\ShippingUnit\Models\ShippingUnit;
use Illuminate\Support\Facades\Cache;

class NinjaVanAPI extends ShippingUnitAbstract
{
    public $sandBoxUrl = 'https://api-sandbox.ninjavan.co/vi';
    public $liveURL = 'https://api.ninjavan.co/vi';
    protected $ninjavan_token_key;
    public function __construct(ShippingUnit $shippingUnit)
    {
        parent::__construct($shippingUnit);
        $this->activeUrl = $this->devMode ? $this->sandBoxUrl : $this->liveURL;
        if(!Cache::get('ninjavan_token_key')){
            $this->login();
        }else{
            $this->ninjavan_token_key = Cache::get('ninjavan_token_key');
        }
    }   

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

    protected function login()
    {
        if(!$this->ninjavan_token_key){
            $result = $this->callApi(array_merge(
                $this->shipping->toSecurityJson(),
                ['grant_type' => 'client_credentials']
            ), 
                'https://api-sandbox.ninjavan.co/vn/2.0/oauth/access_token'
            );
        }
        return true;
    }
}
?>