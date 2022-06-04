<?php

namespace App\Containers\Customer\UI\WEB\Controllers;

use App\Ship\Parents\Controllers\WebController;
use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Customer\UI\WEB\Requests\DeleteCustomerGroupRequest;
use App\Containers\Customer\UI\WEB\Requests\EditCustomerGroupRequest;
use App\Containers\Customer\UI\WEB\Requests\GetAllCustomerGroupRequest;
use App\Containers\Customer\UI\WEB\Requests\StoreCustomerGroupRequest;
use App\Containers\Customer\UI\WEB\Requests\UpdateCustomerGroupRequest;
use App\Ship\core\Traits\HelpersTraits\ApiResTrait;
use App\Ship\Parents\Controllers\AdminController;
use App\Ship\Transporters\DataTransporter;

/**
 * Class CustomerGroupController
 *
 * @package App\Containers\Customer\UI\WEB\Controllers
 */
class CustomerGroupController extends AdminController
{
    use ApiResTrait;

    public function __construct()
    {
      $method = request()->route()->getActionMethod();
      if (in_array($method, ['create', 'create'])) {
        $this->dontUseShareData = true;
      }

      parent::__construct();
    }

    /**
     * Show all entities
     *
     * @param GetAllCustomersRequest $request
     */
    public function index(GetAllCustomerGroupRequest $request)
    {
        Apiato::call('BaseContainer@CreateBreadcrumbAction', ['list', $this->title. 'nhóm khách hàng']);
        $customerGroups = Apiato::call('Customer@GetAllCustomerGroupsAction', []);

        if ($request->ajax()) {
          return $this->sendResponse($customerGroups);
        }
        return view('customer::group.index', [
          'customerGroups' => $customerGroups,
          'input' => $request->all()
        ]);
    }

    /**
     * Show one entity
     *
     * @param FindCustomerByIdRequest $request
     */
    public function show(FindCustomerByIdRequest $request)
    {
        $customer = Apiato::call('Customer@FindCustomerByIdAction', [$request]);

        // ..
    }

    /**
     * Create entity (show UI)
     *
     * @param CreateCustomerRequest $request
     */
    public function create()
    {
        return view('customer::group.create');
    }

    /**
     * Add a new entity
     *
     * @param StoreCustomerRequest $request
     */
    public function store(StoreCustomerGroupRequest $request)
    {
      $transpoter = new DataTransporter($request);
      $customerGroup = Apiato::call('Customer@StoreCustomerGroupsAction', [$transpoter]);
      return redirect()->back()->with([
        'flash_level' => 'success',
        'flash_message' => sprintf('Nhóm khách hàng: %s đã được tạo', $customerGroup->title),
        'objectData' => $customerGroup,
        'viewRender' => 'customer::group.inc.item'
      ]);
    }

    /**
     * Edit entity (show UI)
     *
     * @param EditCustomerRequest $request
     */
    public function edit(EditCustomerGroupRequest $request)
    {
        $customerGroup = Apiato::call('Customer@FindCustomerGroupsByIdAction', [$request]);
        return view('customer::group.edit', [
          'customerGroup' => $customerGroup
        ]);
    }

    /**
     * Update a given entity
     *
     * @param UpdateCustomerRequest $request
     */
    public function update(UpdateCustomerGroupRequest $request)
    {
        $transpoter = new DataTransporter($request);
        $transpoter->id = $request->id;
        $customerGroup = Apiato::call('Customer@UpdateCustomerGroupAction', [$transpoter]);
        return redirect()->back()->with([
          'flash_level' => 'success',
          'flash_message' => sprintf('Nhóm khách hàng: %s đã được cập nhật', $customerGroup->title),
          'objectData' => $customerGroup,
          'viewRender' => 'customer::group.inc.item'
        ]);
    }

    /**
     * Delete a given entity
     *
     * @param DeleteCustomerRequest $request
     */
    public function delete(DeleteCustomerGroupRequest $request)
    {
      $result = Apiato::call('Customer@DeleteCustomerGroupAction', [$request]);
      return $this->sendResponse($result, __('Xóa nhóm khách hàng thành công'));
    }
}
