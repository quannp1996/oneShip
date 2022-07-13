<?php

namespace App\Containers\Customer\UI\WEB\Controllers\FrontEnd;

use Apiato\Core\Traits\ResponseTrait;
use App\Containers\Customer\Enums\EnumAddressBook;
use App\Containers\BaseContainer\UI\WEB\Controllers\NeedAuthController;
use App\Containers\Customer\Actions\AddressBook\GetAllAddressBookAction;
use App\Containers\Customer\UI\WEB\Requests\Address\StoreAddressCustomerRequest;
use App\Containers\Customer\Actions\AddressBook\CreateCustomerAddressBookAction;
use App\Containers\Customer\Actions\AddressBook\DeleteCustomerAddressBookAction;
use App\Containers\Customer\Actions\AddressBook\UpdateCustomerAddressBookAction;
use App\Containers\Customer\UI\WEB\Requests\Address\DeleteAddressCustomerRequest;
use App\Containers\Customer\UI\API\Transformers\FrontEnd\CustomersAddressTransfomer;
use App\Containers\Customer\UI\WEB\Requests\Address\UpdateAddressCustomerRequest;
use App\Ship\core\Traits\HelpersTraits\ApiResTrait;

/**
 * Class CustomerAddress
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class CustomerAddress extends NeedAuthController
{
  use ResponseTrait, ApiResTrait;
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

  public function deleteAddress(DeleteAddressCustomerRequest $request, DeleteCustomerAddressBookAction $deleteCustomerAddressBookAction)
  {
    try {
      $delete = $deleteCustomerAddressBookAction->run($request->id);
      return $this->sendResponse([
        'success' => true,
        'address' => $delete
      ], 'Xóa địa chỉ thành công');
    } catch (\Exception $e) {
      return $this->sendError('', 404, 'Xóa địa chỉ không thành công');
    }
  }

  public function updateAddress(UpdateAddressCustomerRequest $request, UpdateCustomerAddressBookAction $updateCustomerAddressBookAction)
  {
    $address = $updateCustomerAddressBookAction->run($request->id, $request->only(EnumAddressBook::CAN_FILL));
    $address->load(['province', 'district', 'ward']);
    return $this->sendResponse([
      'address' => [
          'id' => $address->id,
          'fullname' => $address->fullname,
          'type' => $address->type,
          'phone' => $address->phone,
          'email' => $address->email,
          'province_id' => $address->province_id,
          'district_id' => $address->district_id,
          'ward_id' => $address->ward_id,
          'village' => $address->village,
          'zipcode' => $address->zipcode,
          'address1' => $address->address1,
          'address2' => $address->address2,
          'is_default' => $address->is_default,
          'addressText' => $address->generateAddress()
      ],
      'type' => $address->type
    ]);
  }
}
