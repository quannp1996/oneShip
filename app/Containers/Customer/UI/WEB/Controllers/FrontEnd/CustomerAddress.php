<?php

namespace App\Containers\Customer\UI\WEB\Controllers\FrontEnd;

use Apiato\Core\Traits\ResponseTrait;
use App\Containers\BaseContainer\UI\WEB\Controllers\NeedAuthController;
use App\Containers\Customer\Actions\AddressBook\CreateCustomerAddressBookAction;
use App\Containers\Customer\Actions\AddressBook\GetAllAddressBookAction;
use App\Containers\Customer\Enums\EnumAddressBook;
use App\Containers\Customer\UI\API\Transformers\FrontEnd\CustomersAddressTransfomer;
use App\Containers\Customer\UI\WEB\Requests\Address\StoreAddressCustomerRequest;

/**
 * Class CustomerAddress
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class CustomerAddress extends NeedAuthController
{
  use ResponseTrait;
  protected $fieldCan = [];
  public function listAddress(GetAllAddressBookAction $getAllAddressBookAction)
  {
    $address = $getAllAddressBookAction->run([
      'customerID' => auth('customer')->id(),
    ], ['province', 'district', 'ward']);
    return $this->transform($address, new CustomersAddressTransfomer());
  }

  public function storeAddress(StoreAddressCustomerRequest $request, CreateCustomerAddressBookAction $createCustomerAddressBookAction)
  {
    $address = $createCustomerAddressBookAction->run(array_merge($request->only(EnumAddressBook::CAN_FILL), [
      'customerID' => auth('customer')->id()
    ]));
    $address->with(['province', 'district', 'ward']);
    return $this->transform($address, new CustomersAddressTransfomer());
  }
}
