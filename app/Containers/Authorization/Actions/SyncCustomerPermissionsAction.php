<?php

namespace App\Containers\Authorization\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Customer\Models\Customer;
use App\Ship\Transporters\DataTransporter;

class SyncCustomerPermissionsAction extends Action
{
  public function run(DataTransporter $data): Customer
  {
      $customer = Apiato::call('Customer@FindCustomerByIdTask', [$data->customer_id]);

      // convert roles IDs to array (in case single id passed)
      $permissionsIds = (array)$data->permissions_ids;

      $permissions = array_map(function ($permissionId) {
          return Apiato::call('Authorization@FindPermissionTask', [$permissionId]);
      }, $permissionsIds);

      $customer->syncPermissions($permissions);

      return $customer;
  }
}
