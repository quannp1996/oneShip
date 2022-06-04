<?php

namespace App\Containers\Customer\Actions;

use App\Ship\Parents\Actions\Action;
use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Customer\Models\Customer;
use App\Ship\Transporters\DataTransporter;

class StoreNewCustomerAction extends Action
{
  public function run(DataTransporter $transporter): ?Customer
  {
    $transporter->password = bcrypt($transporter->password);
    $customerData = $transporter->toArray();
    $customerData['ref_code'] = self::generateNumber();
    $customer = Apiato::call('Customer@CreateCustomerTask', [$customerData]);
    return $customer;
  }
  public function generateNumber()
  {
    $ref_code = strtoupper(\Str::random(8));
    if (Customer::where('ref_code', $ref_code)->count() > 0) self::generateNumber();
    return $ref_code;
  }
}
