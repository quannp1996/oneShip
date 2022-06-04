<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-08-24 13:44:12
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-09-19 23:00:24
 * @ Description: Happy Coding!
 */

namespace App\Containers\Customer\UI\API\Controllers\FrontEnd\Features\AddressBook;

use Apiato\Core\Transformers\Serializers\ArraySerializer;
use App\Containers\Customer\Actions\CusGetAllAddBookAction;
use App\Containers\Customer\Actions\CusSaveAddressBookAction;
use App\Containers\Customer\UI\API\Requests\FrontEnd\AddressBook\UpdateAddressRequest;
use App\Containers\Customer\UI\API\Transformers\FrontEnd\AddressBook\AllAddressBookTransfomer;
use Illuminate\Support\Arr;

trait UpdateAddress
{
    public function updateAddress(UpdateAddressRequest $request)
    {
        // dd($this->user->id);
        $result = app(CusSaveAddressBookAction::class)->run($request->id,$this->user->id,Arr::except($request->all(),['id']));
        
        $addressBook = app(CusGetAllAddBookAction::class)->withRelationships()->run($this->user->id);

        return $this->transform($addressBook,AllAddressBookTransfomer::class,[],[],'address-book');
    }
}
