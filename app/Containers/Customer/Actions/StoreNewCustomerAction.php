<?php

namespace App\Containers\Customer\Actions;

use App\Ship\Parents\Actions\Action;
use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Customer\Models\Customer;
use App\Ship\Transporters\DataTransporter;

class StoreNewCustomerAction extends Action
{
    public function run(DataTransporter $transporter) :? Customer
    {
      $transporter->password = bcrypt($transporter->password);
      $customerData = $transporter->toArray();
      $customer = Apiato::call('Customer@CreateCustomerTask', [$customerData]);
      return $customer;
    }
}
