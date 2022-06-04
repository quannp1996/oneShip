<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-08-24 13:44:12
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-09-19 22:47:35
 * @ Description: Happy Coding!
 */

namespace App\Containers\Customer\UI\API\Controllers\FrontEnd\Features\AddressBook;

use Apiato\Core\Transformers\Serializers\ArraySerializer;
use App\Containers\Customer\Actions\CusGetAllAddBookAction;
use App\Containers\Customer\UI\API\Requests\FrontEnd\AddressBook\GetAllAddressBookRequest;
use App\Containers\Customer\UI\API\Transformers\FrontEnd\AddressBook\AllAddressBookTransfomer;

trait GetCustomerAddressBook
{
    public function GetCustomerAddressBook(GetAllAddressBookRequest $request)
    {
        $addressBook = app(CusGetAllAddBookAction::class)->withRelationships()->run($this->user->id);

        return $this->transform($addressBook,AllAddressBookTransfomer::class,[],[],'address-book');
    }
}
