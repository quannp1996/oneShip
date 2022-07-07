<?php

/**
 * @ Created by: VSCode
 * @ Author: QuanNP - npquan1995@gmai.com
 * @ Create Time: 2021-09-07 13:09:51
 * @ Modified by: QuanNP - npquan1995@gmai.com
 * @ Modified time: 2021-11-16 12:53:26
 * @ Description: Happy Coding!
 */

namespace App\Containers\Customer\UI\API\Transformers\FrontEnd;

use App\Ship\Parents\Transformers\Transformer;
use App\Containers\Customer\Models\CustomerAddressBook;

class CustomersAddressTransfomer extends Transformer
{
    protected array $defaultIncludes = [];
    
    public function transform(CustomerAddressBook $customerAddress)
    {
        return [
            'id' => $customerAddress->id,
            'fullname' => $customerAddress->fullname,
            'type' => $customerAddress->type,
            'phone' => $customerAddress->phone,
            'email' => $customerAddress->email,
            'province' => $customerAddress->province_id,
            'district' => $customerAddress->district_id,
            'ward' => $customerAddress->ward_id,
            'village' => $customerAddress->village,
            'zipcode' => $customerAddress->zipcode,
            'address1' => $customerAddress->address1,
            'address2' => $customerAddress->address2,
            'is_default' => $customerAddress->is_default,
            'addressText' => $customerAddress->generateAddress()
        ];
    }
}
