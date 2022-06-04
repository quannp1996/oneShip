<?php

namespace App\Containers\Customer\UI\WEB\Controllers;

use Apiato\Core\Foundation\Facades\Apiato;
use Apiato\Core\Foundation\FunctionLib;
use App\Containers\Customer\Actions\GetAllCustomersAction;
use App\Containers\Customer\Enums\CustomerStatus;
use App\Containers\Customer\Models\Customer;
use App\Containers\Customer\UI\WEB\Requests\CreateCustomerRequest;
use App\Containers\Customer\UI\WEB\Requests\DeleteCustomerRequest;
use App\Containers\Customer\UI\WEB\Requests\EditCustomerRequest;
use App\Containers\Customer\UI\WEB\Requests\FilterCustomerBySeachableRequest;
use App\Containers\Customer\UI\WEB\Requests\GetAllCustomerRequest;
use App\Containers\Customer\UI\WEB\Requests\UpdateCustomerRequest;
use App\Ship\core\Traits\HelpersTraits\ApiResTrait;
use App\Ship\Parents\Controllers\AdminController;
use App\Ship\Transporters\DataTransporter;

/**
 * Class Controller
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class CustomerController extends AdminController
{
  use ApiResTrait;
  public function __construct()
  {
    if (FunctionLib::isDontUseShareData(['edit', 'store', 'update', 'delete', 'create'])) {
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
    \View::share('breadcrumb', $this->breadcrumb);

    $transporter = new DataTransporter($request);

    $data = app(GetAllCustomersAction::class)
      ->counting([
        ['status' => 1, 'email' => 'an@gmail.com'],
        ['status' => 2, 'email' => 'an@gmail.com'],
        ['status' => 3],
        ['status' => -1],
      ])
      ->run(
        $transporter,
        true,
        ['groups:id,title,display_name'],
        ['id', 'email', 'phone', 'fullname', 'status', 'created_at']
      );

    if ($request->ajax()) {
      return $this->sendResponse($data);
    }

    $roles = Apiato::call('Authorization@GetAllRolesAction', [new DataTransporter([]), 0, true, ['customers']]);
    $groups = Apiato::call('Customer@GetAllCustomerGroupsAction', [
      ['id', 'title', 'display_name']
    ]);
    return view('customer::index', [
      'data' => $data,
      'search_data' => $request,
      'roles' => $roles,
      'groups' => $groups,
      'status' => CustomerStatus::TEXT,
    ]);
  }

  public function create()
  {
    $this->breadcrumb[] = FunctionLib::addBreadcrumb('Khách hàng', route('admin.customers.index'));
    $this->breadcrumb[] = FunctionLib::addBreadcrumb('Tạo khách hàng', route('admin.customers.create'));
    \View::share('breadcrumb', $this->breadcrumb);

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
    \DB::beginTransaction();
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
        \DB::commit();
        return redirect()->back()->with([
          'flash_level' => 'success',
          'flash_message' => sprintf('Khách hàng: %s đã được tạo', $customer->fullname),
          'objectData' => $customer,
          'viewRender' => 'customer::inc.item',
        ]);
      }
    } catch (\Exception $e) {
      \DB::rollback();
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
    $customer = Apiato::call('Customer@FindCustomerByIdAction', [$transporter->id, ['groups', 'addresses', 'addresses.province', 'addresses.district', 'addresses.ward']]);
    return view('customer::edit', [
      'roles' => $roles,
      'all_perms' => $all_perms,
      'groups' => $groups,
      'customer' => $customer
    ]);
  }

  public function update(UpdateCustomerRequest $request)
  {
    \DB::beginTransaction();
    try {
      if (empty($request->password)) {
        $request = $request->except(['password', 'password_confirm']);
      }
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

        \DB::commit();
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
      \DB::rollback();
      throw $e;
      $this->throwExceptionViaMess($e);
    }
  }

  public function filter(FilterCustomerBySeachableRequest $request)
  {
    $transporter = $request->toTransporter();
    $customers = Apiato::call('Customer@FilterCustomerBySeachableAction', [
      $transporter,
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

  public function logReferral(EditCustomerRequest $request)
  {
    $transporter = $request->toTransporter();
    $input = $request->all();
    // dd( $input);
    $type = !empty($transporter->type) ? $transporter->type : 'don_hang';
    $input['type'] = $type;
    $transporter->limit = 10;
    $customer = Apiato::call('Customer@FindCustomerByIdAction', [$transporter->id]);
    if ($type == 'don_hang') {
      $logs = Apiato::call('Customer@GetLogOrderReferralByCustomerAction', [
        $transporter,
        ['order']
      ]);
    } else {

      $transporter->ref_code = $customer->ref_code;
      $logs = Apiato::call('Customer@GetLogReferralByCustomerAction', [
        $transporter,
        ['customerReferraled', 'customerReferral']
      ]);
      // dd( $logs);
    }
    // dd($request->type);
    return view('customer::log_referral', [
      'input' => $input,
      'logs' => $logs,
      'customer' => $customer,
      'customer_id' => $input['id']
    ]);
  }
} // End class
