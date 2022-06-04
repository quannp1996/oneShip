<?php

namespace App\Containers\Authorization\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Transporters\DataTransporter;
use App\Containers\Customer\Models\Customer;

class SyncCustomerRolesAction extends Action
{
  public function run(DataTransporter $data)
  {
      $customer = Apiato::call('Customer@FindCustomerByIdTask', [$data->customer_id]);
      // convert roles IDs to array (in case single id passed)
      $rolesIds = (array)$data->roles_ids;
      $roles = array_map(function ($roleId) {
          return Apiato::call('Authorization@FindRoleTask', [$roleId]);
      }, $rolesIds);

      $customer->syncRoles($roles);

      return $customer;
  }
}
