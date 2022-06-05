<?php

/**
 * @ Created by: VSCode
 * @ Author: QuanNP - npquan1995@gmai.com
 * @ Create Time: 2021-08-24 13:44:12
 * @ Modified by: QuanNP - npquan1995@gmai.com
 * @ Modified time: 2021-09-19 22:52:34
 * @ Description: Happy Coding!
 */

namespace App\Containers\Customer\UI\API\Controllers\FrontEnd\Features\AddressBook;

use App\Containers\Customer\Actions\CusGetAllAddBookAction;
use App\Containers\Customer\Actions\CusSaveAddressBookAction;
use App\Containers\Customer\UI\API\Requests\FrontEnd\AddressBook\NewAddressRequest;
use App\Containers\Customer\UI\API\Transformers\FrontEnd\AddressBook\AllAddressBookTransfomer;

trait NewAddress
{
    public function newAddress(NewAddressRequest $request)
    {
        // dd($this->user->id);
        $result = app(CusSaveAddressBookAction::class)->run(0,$this->user->id,$request->all());
        
        $addressBook = app(CusGetAllAddBookAction::class)->withRelationships()->run($this->user->id);

        return $this->transform($addressBook,AllAddressBookTransfomer::class,[],[],'address-book');
    }
}
