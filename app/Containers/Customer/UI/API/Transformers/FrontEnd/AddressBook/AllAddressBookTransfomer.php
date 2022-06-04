<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-09-18 15:28:43
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-09-19 23:18:58
 * @ Description: Happy Coding!
 */

namespace App\Containers\Customer\UI\API\Transformers\FrontEnd\AddressBook;

use App\Containers\Customer\Models\CustomerAddressBook;
use App\Ship\Parents\Transformers\Transformer;

class AllAddressBookTransfomer extends Transformer
{
    protected $availableIncludes = [];

    protected $defaultIncludes = [];

    public function transform(CustomerAddressBook $object)
    {
        $addressString =  $object->address . '' . (isset($object->ward->name) ? ', '.$object->ward->name : '') .
            (isset($object->district->name) ? ', '.$object->district->name : '') .
            (isset($object->province->name) ? ', '.$object->province->name : '');

        $response = [
            'id' => $object->id,
            'is_default' => $object->is_default,
            'name' => $object->name,
            'phone' => $object->phone,
            'province_id' => $object->province_id,
            'district_id' => $object->district_id,
            'ward_id' => $object->ward_id,
            'address' => $object->address,
            'geo_address' => $addressString,
            'is_on_working_time' => $object->is_on_working_time
        ];

        return $response;
    }
}
