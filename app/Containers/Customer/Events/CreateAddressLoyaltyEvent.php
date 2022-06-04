<?php

namespace App\Containers\Customer\Events;

use App\Ship\Parents\Events\Event;
use Apiato\Core\Abstracts\Events\Interfaces\ShouldHandleNow;
use Illuminate\Queue\SerializesModels;
use App\Containers\Customer\Models\Customer;
use App\Containers\EShopBizfly\Actions\Geos\CreateNewAddressShippingAction;
use App\Containers\EShopBizfly\Tasks\Customers\CreateCustomerEShopTask;
use Illuminate\Support\Facades\Log;


class CreateAddressLoyaltyEvent extends Event implements ShouldHandleNow
{
    use SerializesModels;

    public $customer;
    public $data;
    public $city;
    public $district;
    public $ward;

    public function __construct(Customer $customer, $data, $city, $district, $ward)
    {
        if(!empty($customer) && !empty($data['province_id']) && !empty($data['district_id']) && !empty($data['ward_id'])){

            if(empty($customer->eshop_customer_id)){
                $createCustomerResponseValue = app(CreateCustomerEShopTask::class)->run($customer);
                if ($createCustomerResponseValue->isSuccess()) {
                    $customer->eshop_customer_id = $createCustomerResponseValue->response['data']['id'];
                    $customer->save();
                    $r = app(CreateNewAddressShippingAction::class)->run(
                        $customer,
                        $city,
                        $district,
                        $ward,
                        $data['name'],
                        $data['phone'],
                        $data['address']
                    );
                }else {
                    Log::error("Push ESHOP ID error: " . $createCustomerResponseValue->toJson());
                }
            }else{
                $r = app(CreateNewAddressShippingAction::class)->run(
                    $customer,
                    $city,
                    $district,
                    $ward,
                    $data['name'],
                    $data['phone'],
                    $data['address']
                );
            }
            
        }
    }

    /**
     * Handle the Event. (Single Listener Implementation)
     */
    public function handle()
    {
        // Do some handling here
    }

}
