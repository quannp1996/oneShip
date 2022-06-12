<?php

namespace App\Containers\Customer\UI\WEB\Controllers;

use Apiato\Core\Foundation\Facades\Apiato;
use Apiato\Core\Foundation\Facades\FunctionLib;
use Apiato\Core\Foundation\FunctionLib as FoundationFunctionLib;
use App\Containers\Customer\UI\WEB\Controllers\Features\TraitBase;
use App\Containers\Customer\UI\WEB\Controllers\Features\TraitPrices;
use App\Containers\Customer\UI\WEB\Controllers\Features\TraitStatus;
use App\Containers\Customer\UI\WEB\Requests\CreateCustomerRequest;
use App\Containers\Customer\UI\WEB\Requests\DeleteCustomerRequest;
use App\Containers\Customer\UI\WEB\Requests\EditCustomerRequest;
use App\Containers\Customer\UI\WEB\Requests\FilterCustomerBySeachableRequest;
use App\Containers\Customer\UI\WEB\Requests\GetAllCustomerRequest;
use App\Containers\Customer\UI\WEB\Requests\UpdateCustomerRequest;
use App\Ship\core\Traits\HelpersTraits\ApiResTrait;
use App\Ship\Parents\Controllers\AdminController;
use App\Ship\Transporters\DataTransporter;
use Illuminate\Support\Facades\DB;

/**
 * Class Controller
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class CustomerController extends AdminController
{
  use ApiResTrait, TraitStatus, TraitBase, TraitPrices;
  public function __construct()
  {
    if (FoundationFunctionLib::isDontUseShareData(['edit', 'store', 'update', 'delete', 'create'])) {
      $this->dontUseShareData = true;
    }
    parent::__construct();
  }

  /**
   * @return  \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   */
  public function index(GetAllCustomerRequest $request)
  {
    $this->breadcrumb[] = FunctionLib::addBreadcrumb('Khách hàng', route('admin.customers.index'));
    $this->breadcrumb[] = FunctionLib::addBreadcrumb('Danh sách');
    view()->share('breadcrumb', $this->breadcrumb);
    $customers = Apiato::call('Customer@GetAllCustomersAction', [
      new DataTransporter($request),
      true,
      ['groups:id,title,display_name'],
    ]);

    if ($request->ajax()) return $this->sendResponse($customers);

    $roles = Apiato::call('Authorization@GetAllRolesAction', [new DataTransporter([]), 0, true, ['customers']]);
    $groups = Apiato::call('Customer@GetAllCustomerGroupsAction', [
      ['id', 'title', 'display_name']
    ]);
    return view('customer::index', [
      'customers' => $customers,
      'input' => $request->all(),
      'roles' => $roles,
      'groups' => $groups
    ]);
  }

  public function create()
  {
    $this->breadcrumb[] = FunctionLib::addBreadcrumb('Khách hàng', route('admin.customers.index'));
    $this->breadcrumb[] = FunctionLib::addBreadcrumb('Tạo khách hàng', route('admin.customers.create'));
    view()->share('breadcrumb', $this->breadcrumb);

    $roles = Apiato::call('Authorization@GetAllRolesAction', [new DataTransporter([]), 0, true, ['customers']]);
    $all_perms = Apiato::call('Authorization@GetAllPermToGroupAction', [['customers']]);
    $groups = Apiato::call('Customer@GetAllCustomerGroupsAction', []);

    return view('customer::create', [
      'roles' => $roles,
      'all_perms' => $all_perms,
      'groups' => $groups
    ]);
  }

  public function store(CreateCustomerRequest $request)
  {
    DB::beginTransaction();
    try {
      $transporter = new DataTransporter($request);
      $customer = Apiato::call('Customer@StoreNewCustomerAction', [$transporter]);
      if ($customer) {
        $transporter->customer_id = $customer->id;
        if (!empty($transporter->roles_ids)) {
          $role = Apiato::call('Authorization@SyncCustomerRolesAction', [$transporter]);
        }

        if (!empty($transporter->permissions_ids)) {
          $perm = Apiato::call('Authorization@SyncCustomerPermissionsAction', [$transporter]);
        }

        if (!empty($transporter->customer_group_ids)) {
          $customerGroups = Apiato::call('Customer@SyncCustomerToGroupAction', [$customer, $transporter->customer_group_ids]);
        }

        $customer->load(['roles:id,display_name', 'groups:id,title']);
        $customer->toArray();
        DB::commit();
        return redirect()->back()->with([
          'flash_level' => 'success',
          'flash_message' => sprintf('Khách hàng: %s đã được tạo', $customer->fullname),
          'objectData' => $customer,
          'viewRender' => 'customer::inc.item',
        ]);
      }
    } catch (\Exception $e) {
      DB::rollback();
      throw $e;
      $this->throwExceptionViaMess($e);
    }
  }

  public function delete(DeleteCustomerRequest $request)
  {
    $row = Apiato::call('Customer@DeleteCustomerAction', [$request]);
    return $this->sendResponse($row, __('Xóa khách hàng thành công'));
  }

  public function edit(EditCustomerRequest $request)
  {
    $transporter = $request->toTransporter();
    $roles = Apiato::call('Authorization@GetAllRolesAction', [new DataTransporter([]), 0, true, ['customers']]);
    $all_perms = Apiato::call('Authorization@GetAllPermToGroupAction', [['customers']]);
    $groups = Apiato::call('Customer@GetAllCustomerGroupsAction', []);
    $customer = Apiato::call('Customer@FindCustomerByIdAction', [$transporter->id, ['groups']]);

    return view('customer::edit', [
      'roles' => $roles,
      'all_perms' => $all_perms,
      'groups' => $groups,
      'customer' => $customer
    ]);
  }

  public function update(UpdateCustomerRequest $request)
  {
    DB::beginTransaction();
    try {
      $transporter = new DataTransporter($request);

      $customer = Apiato::call('Customer@UpdateCustomerAction', [$transporter]);
      if ($customer) {
        $transporter->customer_id = $customer->id;
        if (!empty($transporter->roles_ids)) {
          $role = Apiato::call('Authorization@SyncCustomerRolesAction', [$transporter]);
        }

        if (!empty($transporter->permissions_ids)) {
          $perm = Apiato::call('Authorization@SyncCustomerPermissionsAction', [$transporter]);
        }

        if (!empty($transporter->customer_group_ids)) {
          $customerGroups = Apiato::call('Customer@SyncCustomerToGroupAction', [$customer, $transporter->customer_group_ids]);
        }

        DB::commit();
        $customer->load(['roles:id,display_name', 'groups:id,title']);
        $customer = $customer->toArray();
        return redirect()->back()->with([
          'flash_level' => 'success',
          'flash_message' => sprintf('Khách hàng: %s đã được cập nhật', $customer['fullname']),
          'objectData' => $customer,
          'viewRender' => 'customer::inc.item'
        ]);
      }
    } catch (\Exception $e) {
      DB::rollback();
      throw $e;
      $this->throwExceptionViaMess($e);
    }
  }

  public function filter(FilterCustomerBySeachableRequest $request)
  {
    $customers = Apiato::call('Customer@FilterCustomerBySeachableAction', [
      $request->toTransporter(),
      [],
      [
        'id',
        'fullname',
        'email',
        'phone'
      ]
    ]);
    return $this->sendResponse($customers);
  }
} 
// End class
