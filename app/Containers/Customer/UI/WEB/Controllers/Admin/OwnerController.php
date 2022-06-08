<?php

namespace App\Containers\Customer\UI\WEB\Controllers\Admin;


use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Ship\Transporters\DataTransporter;
use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Controllers\AdminController;
use App\Containers\Contractor\UI\WEB\Requests\ActiveContractorRequest;
use App\Containers\Customer\UI\WEB\Requests\AddCustomerRequest;
use App\Containers\Customer\UI\WEB\Requests\BlockCustomerRequest;
use App\Containers\Customer\UI\WEB\Requests\CreateCustomerRequest;
use App\Containers\Customer\UI\WEB\Requests\EditCustomerRequest;
use App\Containers\Customer\UI\WEB\Requests\GetAllOwnerRequest;
use App\Containers\Customer\UI\WEB\Requests\UpdateCustomerRequest;
use App\Ship\core\Traits\HelpersTraits\ApiResTrait;

/**
 * Class OwnerController
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class OwnerController extends AdminController
{
    use ApiResTrait;

    public function __construct()
    {
        $this->title = __('customer::admin.title');
        parent::__construct();
    }

    public function listOwner(GetAllOwnerRequest $request)
    {
        Apiato::call('BaseContainer@CreateBreadcrumbAction', ['list', $this->title]);
        $dataTransporter = new DataTransporter(array_merge(['is_contractor' => 0, 'status' => 2], $request->all()));
        $owners = Apiato::call('Customer@GetAllCustomersAction', [$dataTransporter, true, ['mainAddress', 'latestBuilding']]);
        $countOwners = Apiato::call('Customer@CountOwnersByStatusAction', []);
        return view('customer::Admin.list_owner', [
          'owners' => $owners,
          'countOwners' =>$countOwners,
          'searchData' => array_merge(['status' => 2], $request->all())
        ]);
    }

    public function addOwner(AddCustomerRequest $request){

      Apiato::call('BaseContainer@CreateBreadcrumbAction', ['add', $this->title, 'owner.list']);
      $allCities = Apiato::call('Location@GetAllCitiesAction', [false]);
      return view('customer::Admin.add_owner', [
        'allCities' => $allCities
      ]);
    }

    public function storeOwner(CreateCustomerRequest $request){
      $dataTransporter = new DataTransporter([
        'email' => $request->email,
        'user_name' => $request->email,
        'fullname' => $request->fullname,
        'phone' => $request->phone,
        'password' => Str::random(10),
        'status' => 1,
        'is_contractor' => 0
      ]);
      /**
      * Upload Avatar Image
      */
      $this->uploadImage($dataTransporter, $request, 'avatar', 'owner_avatar', 'customer');
      DB::beginTransaction();
      try{
        $owner = Apiato::call('Customer@StoreNewCustomerAction', [$dataTransporter]);
        /**
         * Sync AddressBook
         */
        $address_book = (array) $request->address_book;
        $address_book['is_main'] = 1;
        $address_book['customer_id'] = $owner->id;
        Apiato::call('Contractor@SyncAddressContractorTask', [$owner->id, [$address_book]]);
        /**
         * Add to User Log
         */
        Apiato::call('User@CreateUserLogSubAction', [
            $owner->id,
            [],
            $owner->toArray(),
            __('owner::admin.log_message.add', [
              'string' => @$owner->fullname
            ]),
            get_class($owner)
        ]);
        DB::commit();
        return redirect()->back()->with([
          'flash_level' => 'success',
          'flash_message' => __('customer::admin.add.success_message', [
            'string' => $owner->fullname
          ]),
          'objectData' => $owner,
          'viewRender' => 'customer::inc.item',
        ]);
      }catch(\Exception $e){
        DB::rollBack();
        $this->throwExceptionViaMess($e);
      }
    }

    public function editOwner(EditCustomerRequest $request){

        Apiato::call('BaseContainer@CreateBreadcrumbAction', ['edit', $this->title, 'owner.list']);
        $owner = Apiato::call('Customer@FindCustomerByIdAction', [$request->id, ['mainAddress']]);
        if(!$owner) return $this->notfound($request->id);
        $allCities = Apiato::call('Location@GetAllCitiesAction', [false]);
        $allDistricts = Apiato::call('Location@GetAllDistrictsAction', [false, [], ['province_id' => $owner->mainAddress->city_id ?? 0]]);
        $allWards = Apiato::call('Location@GetAllWardsAction', [false, [], ['district_id' => $owner->mainAddress->district_id ?? 0]]);
        return view('customer::Admin.edit_owner', [
          'owner' => $owner,
          'allCities' => $allCities,
          'allDistricts' => $allDistricts,
          'allWards' => $allWards
        ]);
    }

    /**
     * Update Data of an Owner
     *
     * @param UpdateCustomerRequest $request
     */
    public function updateOwner(UpdateCustomerRequest $request){
      DB::beginTransaction();
      try{
        $dataTransporter = new DataTransporter($request);
        /**
         * Upload Avatar
         */
        $this->uploadImage($dataTransporter, $request, 'avatar', 'owner_avatar', 'customer');
        $owner = Apiato::call('Customer@UpdateCustomerAction', [$dataTransporter]);
        /**
         * Sync AddressBook
         */
        $address_book = (array) $request->address_book;
        $address_book['is_main'] = 1;
        $address_book['customer_id'] = $owner->id;
        Apiato::call('Contractor@SyncAddressContractorTask', [$owner->id, [$address_book]]);
        /**
         * Push Notification
         */
        // Apiato::call('Notification@PushNotificationAction', [collect(User::all()), new NotificationStructureValue('Update User', '#', [], [])]);
        DB::commit();
        return redirect(route('owner.list'))->with([
          'flash_level' => 'success',
          'flash_message' => __('customer::admin.edit.success_message', [
            'string' => $owner->fullname
          ]),
          'objectData' => $owner,
          'viewRender' => 'customer::inc.item'
        ]);
      }catch(\Exception $e){
        DB::rollBack();
        $this->throwExceptionViaMess($e);
      }
    }

    /**
     * Show Edit Form an Owner
     *
     * @param EditCustomerRequest $request
     */
    public function showOwner(EditCustomerRequest $request){

      Apiato::call('BaseContainer@CreateBreadcrumbAction', ['detail', $this->title, 'owner.list']);
      $owner = Apiato::call('Customer@FindCustomerByIdAction', [$request->id, ['mainAddress', 'someComments'], ['comments', 'buildings', 'follow']]);
      if(!$owner) return $this->notfound($request->id);
      return view('customer::Admin.detail_owner', [
        'owner' => $owner
      ]);
    }

    /**
     * Block a Customer
     *
     * @param BlockCustomerRequest $request
     */
    public function blockOwner(BlockCustomerRequest $request){
      DB::beginTransaction();
      try{
        $owner = Apiato::call('Customer@UpdateCustomerAction', [new DataTransporter([
          'id' => $request->id,
          'status' => config('user-container.status.blocked')
        ])]);
        /**
         * Add to User Log
        */
        Apiato::call('User@CreateUserLogSubAction', [
            $owner->id,
            [],
            $owner->toArray(),
            __('customer::admin.log_message.block', [
              'string' => $owner->name
            ]),
          get_class($owner)
        ]);
        DB::commit();
        return redirect(route('owner.list'))->with([
          'flash_level' => 'success',
          'flash_message' => __('customer::admin.edit.success_blockmessage', [
            'string' => $owner->fullname
          ]),
          'objectData' => $owner,
          'viewRender' => 'customer::inc.item'
        ]);
      }catch(\Exception $e){
        DB::rollBack();
        $this->throwExceptionViaMess($e);
      }
    }

    /**
     * UnBlock a Customer
     *
     * @param BlockCustomerRequest $request
     */
    public function unBlockOwner(BlockCustomerRequest $request){
      DB::beginTransaction();
      try{
        $owner = Apiato::call('Customer@UpdateCustomerAction', [new DataTransporter([
          'id' => $request->id,
          'status' => config('user-container.status.actived')
        ])]);

        /**
         * Add to User Log
        */
        Apiato::call('User@CreateUserLogSubAction', [
            $owner->id,
            [],
            $owner->toArray(),
            __('customer::admin.log_message.unblock', [
              'string' => $owner->name
            ]),
          get_class($owner)
        ]);
        DB::commit();
        return redirect(route('owner.list'))->with([
          'flash_level' => 'success',
          'flash_message' => __('customer::admin.edit.success_unblockmessage', [
            'string' => $owner->fullname
          ]),
          'objectData' => $owner,
          'viewRender' => 'customer::inc.item'
        ]);
      }catch(\Exception $e){
        DB::rollBack();
        $this->throwExceptionViaMess($e);
      }
    }

    /**
     * Active a Customer
     *
     * @param BlockCustomerRequest $request
     */
    public function activeOwner(ActiveContractorRequest $request){

      DB::beginTransaction();
      try{
        $owner = Apiato::call('Customer@UpdateCustomerAction', [new DataTransporter([
          'id' => $request->id,
          'status' => config('user-container.status.actived')
        ])]);
        /**
         * Add to User Log
        */
        Apiato::call('User@CreateUserLogSubAction', [
            $owner->id,
            [],
            $owner->toArray(),
            __('customer::admin.log_message.active', [
              'string' => $owner->name
            ]),
          get_class($owner)
        ]);
        DB::commit();
        return redirect(route('owner.list'))->with([
          'flash_level' => 'success',
          'flash_message' => __('customer::admin.edit.success_activeMessage', [
            'string' => $owner->fullname
          ]),
          'objectData' => $owner,
          'viewRender' => 'customer::inc.item'
        ]);
      }catch(\Exception $e){
        DB::rollBack();
        $this->throwExceptionViaMess($e);
      }
    }

    /**
     * Active a Customer
     *
     * @param BlockCustomerRequest $request
     */
    public function deleteOwner(ActiveContractorRequest $request){

      DB::beginTransaction();
      try{
        $owner = Apiato::call('Customer@UpdateCustomerAction', [new DataTransporter([
          'id' => $request->id,
          'status' => config('user-container.status.deleted')
        ])]);
        DB::commit();
        return redirect(route('owner.list'))->with([
          'flash_level' => 'success',
          'flash_message' => __('customer::admin.edit.success_deleteMessage', [
            'string' => $owner->fullname
          ]),
          'objectData' => $owner,
          'viewRender' => 'customer::inc.item'
        ]);
      }catch(\Exception $e){
        DB::rollBack();
        $this->throwExceptionViaMess($e);
      }
    }
    /**
     * Get All Customer for Ajax Request
     */
    public function ajaxOwner(GetAllOwnerRequest $request){

      $dataTransporter = new DataTransporter(array_merge(['status' => 2], $request->all()));
      $owners = Apiato::call('Customer@GetAllCustomersAction' ,[$dataTransporter, false, ['contractor']]);
      return $this->sendResponse($owners);
    }
} 
// End class
