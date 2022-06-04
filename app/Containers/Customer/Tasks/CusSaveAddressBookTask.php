<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-08-28 21:46:47
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-09-19 23:23:54
 * @ Description: Happy Coding!
 */

namespace App\Containers\Customer\Tasks;

use App\Containers\Customer\Data\Repositories\CustomerAddressBookRepository;
use App\Containers\Customer\Models\Customer;
use App\Containers\Customer\Models\CustomerAddressBook;
use App\Containers\Location\Models\City;
use App\Containers\Location\Models\District;
use App\Containers\Location\Models\Ward;
use App\Containers\EShopBizfly\Actions\Geos\UpdateAddressShippingAction;
// use App\Containers\Customer\Events\CreateAddressLoyaltyEvent;
use App\Containers\EShopBizfly\Actions\Geos\CreateNewAddressShippingAction;
use App\Ship\Parents\Tasks\Task;
use Exception;

class CusSaveAddressBookTask extends Task
{
    protected $repository;

    public function __construct(CustomerAddressBookRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(int $id = 0,int $customerId, array $data, bool $isCreating = true): ?CustomerAddressBook
    {
        try {
            if(isset($data['is_default']) && $data['is_default']) {
                $data['is_default'] = 1;
                $this->repository->getModel()->where('customer_id',$customerId)->update(['is_default' => 0]);
            }else {
                $data['is_default'] = 0;
            }
            $city = City::where('id',$data['province_id'])->first();
            $district = District::where('id', $data['district_id'])->first();
            $ward = Ward::where('id', $data['ward_id'])->first(); 
            $data['customer_id'] = $customerId;
            $customer = Customer::whereNotNull(['loyalty_customer_code'])->where('id',$customerId)->first();
            if ($isCreating && $id == 0) {
                $result = $this->repository->create($data);
                if(!empty($result)){
                   $r = app(CreateNewAddressShippingAction::class)->run($customer,$city, $district, $ward, $data['name'], $data['phone'], $data['address']);
                }
                if(isset($r->response['data']['id'])){
                    $this->repository->getModel()->where('id',$result->id)->update(['eshop_shipping_id' => $r->response['data']['id']]);
                }
                return $result;
            } else {
                $result = $this->repository->update($data, $id);
                if(!empty($result) && !empty($customer) && !empty($data['province_id']) && !empty($data['district_id']) && !empty($data['ward_id']) && !empty($result->eshop_shipping_id)){
                    $r = app(UpdateAddressShippingAction::class)->run(
                        $result->eshop_shipping_id,
                        $customer,
                        $city,
                        $district,
                        $ward,
                        $data['name'],
                        $data['phone'],
                        $data['address']
                    );
                }
                return $result;
            }
        } catch (Exception $exception) {
            throw $exception;
        }
    }
}
