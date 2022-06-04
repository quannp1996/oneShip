<?php

namespace App\Containers\Customer\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Transporters\DataTransporter;

class UpdateCustomerAction extends Action
{
    public function run(DataTransporter $transporter)
    {
      if (!empty($transporter->password)) {
        $transporter->password = bcrypt($transporter->password);
        $transporter->password_encode = bcrypt($transporter->password);
      }
      $customerPostData = $transporter->toArray();
      $customer = Apiato::call('Customer@UpdateCustomerTask', [$transporter->id, $customerPostData]);
      if($transporter->address_book){
          $addressBook = array_merge((array) $transporter->address_book, [
            'customer_id' => $transporter->id,
            'is_main' => 1
          ]);
          Apiato::call('Customer@SyncAddressBookCustomerTask', [$transporter->id, $addressBook]);
      }
      return $customer;
    }
}
