<?php 
namespace App\Containers\ShippingUnit\Business\Services;

use Illuminate\Support\Facades\Cache;
use App\Containers\ShippingUnit\Models\ShippingUnit;
use App\Containers\ShippingUnit\Business\ShippingUnitAbstract;

class NinjaVanAPI extends ShippingUnitAbstract
{
    const TOKENKEY = 'ninjavan_token_key';

    protected $version = '4.1';

    protected $sandBoxUrl = 'https://api-sandbox.ninjavan.co/vn';
    
    protected $liveURL = 'https://api.ninjavan.co/vn';

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

    public function send()
    {
        $url = $this->liveURL.'/'.$this->version.'/orders';
        $packages = json_decode($this->order->packages, true);
        $result = $this->callApi([
            'Authorization: Bearer '.$this->ninjavan_token_key,
            'Content-Type: application/json',
        ], [
            'service_type' => 'Parcel',
            'service_level' => 'Standard',
            'reference' => [
                'merchant_order_number' => $this->order->id
            ],
            'from' => [
                'name' => $this->order->sender_name, 
                'phone_number' => $this->order->sender_phone, 
                'email' => $this->order->sender_email, 
                'address' => [
                    'country' => 'VN',
                    'postcode' => $this->order->sender_zipcode,
                    'address1' => $this->order->sender_address1,
                    'address2' => $this->order->sender_address2,
                ]
            ],
            'to' => [
                'name' => $this->order->receiver_name, 
                'phone_number' => $this->order->receiver_phone, 
                'email' => $this->order->receiver_email, 
                'address' => [
                    'country' => 'VN',
                    'postcode' => $this->order->receiver_zipcode,
                    'address1' => $this->order->receiver_address1,
                    'address2' => $this->order->receiver_address2,
                ]
            ],
            'parcel_job' => [
                'dimensions' => [
                    'weight' => $packages['weight']
                ],
                'items' => array_map(function($item){
                    return [
                        'item_description' => $item['productName'],
                        'quantity' => $item['quanlity']
                    ];
                }, $packages['list'])
            ]    
        ], $url);
        dd($result);
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
            $result = $this->callApi(['Content-Type: application/json'], array_merge(
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