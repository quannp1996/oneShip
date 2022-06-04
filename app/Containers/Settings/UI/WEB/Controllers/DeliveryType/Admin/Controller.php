<?php

namespace App\Containers\Settings\UI\WEB\Controllers\DeliveryType\Admin;

use Apiato\Core\Foundation\Facades\FunctionLib;
use Apiato\Core\Foundation\Facades\Apiato;
use Apiato\Core\Foundation\StringLib;
use App\Containers\BaseContainer\Actions\CreateBreadcrumbAction;
use App\Containers\Localization\Actions\GetDefaultLanguageAction;
use App\Containers\Settings\Actions\DeliveryType\DeleteDeliveryTypeAction;
use App\Containers\Settings\Actions\DeliveryType\DeliveryTypeListingAction;
use App\Containers\Settings\Actions\DeliveryType\DisableDeliveryTypeAction;
use App\Containers\Settings\Actions\DeliveryType\EnableDeliveryTypeAction;
use App\Containers\Settings\Actions\DeliveryType\UpdateDeliveryTypeAction;
use App\Containers\Settings\UI\WEB\Requests\DeliveryType\Admin\CreateDeliveryTypeRequest;
use App\Containers\Settings\UI\WEB\Requests\DeliveryType\Admin\FindDeliveryTypeRequest;
use App\Containers\Settings\UI\WEB\Requests\DeliveryType\Admin\GetAllDeliveryTypeRequest;
use App\Containers\Settings\UI\WEB\Requests\DeliveryType\Admin\UpdateDeliveryTypeRequest;
use App\Ship\Parents\Controllers\AdminController;
use Exception;

class Controller extends AdminController
{
    public function __construct()
    {
        $this->title = 'Delivery Types';

        parent::__construct();
    }
    /**
     * @return  \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(GetAllDeliveryTypeRequest $request)
    {
        app(CreateBreadcrumbAction::class)->run('list', $this->title);

        $data = app(DeliveryTypeListingAction::class)->run($request->all(),app(GetDefaultLanguageAction::class)->run(), $this->perPage);

        return view('settings::admin.deliverytype.index', [
            'search_data' => $request,
            'data' => $data,
        ]);
    }

    public function edit(FindDeliveryTypeRequest $request)
    {
        $this->showEditForm();
        app(CreateBreadcrumbAction::class)->run('edit', $this->title, 'admin_deliverytype_home_page');

        try{
            $deliverytype = Apiato::call('Settings@DeliveryType\FindDeliveryTypeByIdAction', [$request->id]);

        }catch(Exception $e){
            throw $e;
            return redirect()->route('admin_deliverytype_home_page', ['id' => $request->id])->with('status', 'Có lỗi');
        }
// dd(config('deliverytype-container.positions'));
        return view('settings::admin.deliverytype.edit', [
            'data' => $deliverytype,
        ]);
    }

    public function add()
    {
        $this->showAddForm();
        app(CreateBreadcrumbAction::class)->run('add', $this->title, 'admin_deliverytype_home_page');

        return view('settings::admin.deliverytype.edit', [

        ]);
    }

    public function update(UpdateDeliveryTypeRequest $request)
    {
        try {
            $arrData = $request->all();

            if (isset($request->image)) {
                $image = Apiato::call('File@UploadImageAction', [$request, 'image', 'setting', StringLib::getClassNameFromString(Banner::class)]);
                if (!$image['error']) {
                    $arrData['image'] = $image['fileName'];
                }
            }

            $object = app(UpdateDeliveryTypeAction::class)->run($arrData);

            if ($object) {
                return redirect()->route('admin_deliverytype_edit_page', ['id' => $object->id])->with('status', 'Cập nhật thành công');
            }
        } catch (\Exception $e) {
            return $this->throwExceptionViaMess($e);
        }
    }

    public function create(CreateDeliveryTypeRequest $request)
    {
        try {
            $arrData = $request->all();
            if (isset($request->image)) {
                $image = Apiato::call('File@UploadImageAction', [$request, 'image', 'setting', StringLib::getClassNameFromString(Banner::class)]);
                if (!$image['error']) {
                    $arrData['image'] = $image['fileName'];
                }
            }

            $deliverytype = Apiato::call('Settings@DeliveryType\CreateDeliveryTypeAction', [$arrData]);
            if ($deliverytype) {
                return redirect()->route('admin_deliverytype_home_page')->with('status', 'Đã thêm mới thành công');
            }
        } catch (\Exception $e) {
            // throw $e;
            return $this->throwExceptionViaMess($e);
        }
    }

    public function delete(FindDeliveryTypeRequest $request)
    {
        try {
            app(DeleteDeliveryTypeAction::class)->run($request->all());
        } catch (\Exception $e) {
            // throw $e;
            return $this->throwExceptionViaMess($e);
        }
    }

    public function enable(FindDeliveryTypeRequest $request){
        try {
            app(EnableDeliveryTypeAction::class)->run($request->all());
            return FunctionLib::ajaxRespondV2(true,'Success');
        } catch (\Exception $e) {
            // throw $e;
            return $this->throwExceptionViaMess($e);
        }
    }

    public function disable(FindDeliveryTypeRequest $request){
        try {
            app(DisableDeliveryTypeAction::class)->run($request->all());
            return FunctionLib::ajaxRespondV2(true,'Success');
        } catch (\Exception $e) {
            // throw $e;
            return $this->throwExceptionViaMess($e);
        }
    }
}
