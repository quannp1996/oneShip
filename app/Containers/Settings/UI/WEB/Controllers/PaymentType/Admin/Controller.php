<?php

namespace App\Containers\Settings\UI\WEB\Controllers\PaymentType\Admin;

use Apiato\Core\Foundation\Facades\FunctionLib;
use Apiato\Core\Foundation\Facades\Apiato;
use Apiato\Core\Foundation\StringLib;
use App\Containers\BaseContainer\Actions\CreateBreadcrumbAction;
use App\Containers\Localization\Actions\GetDefaultLanguageAction;
use App\Containers\Settings\Actions\PaymentType\DeletePaymentTypeAction;
use App\Containers\Settings\Actions\PaymentType\PaymentTypeListingAction;
use App\Containers\Settings\Actions\PaymentType\DisablePaymentTypeAction;
use App\Containers\Settings\Actions\PaymentType\EnablePaymentTypeAction;
use App\Containers\Settings\Actions\PaymentType\UpdatePaymentTypeAction;
use App\Containers\Settings\UI\WEB\Requests\PaymentType\Admin\CreatePaymentTypeRequest;
use App\Containers\Settings\UI\WEB\Requests\PaymentType\Admin\FindPaymentTypeRequest;
use App\Containers\Settings\UI\WEB\Requests\PaymentType\Admin\GetAllPaymentTypeRequest;
use App\Containers\Settings\UI\WEB\Requests\PaymentType\Admin\UpdatePaymentTypeRequest;
use App\Ship\Parents\Controllers\AdminController;
use Exception;
use Illuminate\Support\Facades\Config;

class Controller extends AdminController
{
    public function __construct()
    {
        $this->title = 'Payment Types';

        parent::__construct();
    }
    /**
     * @return  \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(GetAllPaymentTypeRequest $request)
    {
        app(CreateBreadcrumbAction::class)->run('list', $this->title);

        $data = app(PaymentTypeListingAction::class)->run($request->all(),app(GetDefaultLanguageAction::class)->run(), $this->perPage);

        return view('settings::admin.paymenttype.index', [
            'search_data' => $request,
            'data' => $data,
        ]);
    }

    public function edit(FindPaymentTypeRequest $request)
    {
        $this->showEditForm();
        app(CreateBreadcrumbAction::class)->run('edit', $this->title, 'admin_paymenttype_home_page');

        try{
            $paymenttype = Apiato::call('Settings@PaymentType\FindPaymentTypeByIdAction', [$request->id]);

        }catch(Exception $e){
            throw $e;
            return redirect()->route('admin_paymenttype_home_page', ['id' => $request->id])->with('status', 'Có lỗi');
        }
        return view('settings::admin.paymenttype.edit', [
            'data' => $paymenttype,
            'onlineMethods' => Config::get('payment-container.gateways'),
        ]);
    }

    public function add()
    {
        $this->showAddForm();
        app(CreateBreadcrumbAction::class)->run('add', $this->title, 'admin_paymenttype_home_page');

        return view('settings::admin.paymenttype.edit', [
            'onlineMethods' => Config::get('payment-container.gateways'),
        ]);
    }

    public function update(UpdatePaymentTypeRequest $request)
    {
        try {
            $arrData = $request->all();

            if (isset($request->image)) {
                $image = Apiato::call('File@UploadImageAction', [$request, 'image', 'setting', StringLib::getClassNameFromString(Banner::class)]);
                if (!$image['error']) {
                    $arrData['image'] = $image['fileName'];
                }
            }

            $object = app(UpdatePaymentTypeAction::class)->run($arrData);

            if ($object) {
                return redirect()->route('admin_paymenttype_edit_page', ['id' => $object->id])->with('status', 'Cập nhật thành công');
            }
        } catch (\Exception $e) {
            return $this->throwExceptionViaMess($e);
        }
    }

    public function create(CreatePaymentTypeRequest $request)
    {
        try {
            $arrData = $request->all();
            if (isset($request->image)) {
                $image = Apiato::call('File@UploadImageAction', [$request, 'image', 'setting', StringLib::getClassNameFromString(Banner::class)]);
                if (!$image['error']) {
                    $arrData['image'] = $image['fileName'];
                }
            }

            $paymenttype = Apiato::call('Settings@PaymentType\CreatePaymentTypeAction', [$arrData]);
            if ($paymenttype) {
                return redirect()->route('admin_paymenttype_home_page')->with('status', 'Đã thêm mới thành công');
            }
        } catch (\Exception $e) {
            // throw $e;
            return $this->throwExceptionViaMess($e);
        }
    }

    public function delete(FindPaymentTypeRequest $request)
    {
        try {
            app(DeletePaymentTypeAction::class)->run($request->all());
        } catch (\Exception $e) {
            // throw $e;
            return $this->throwExceptionViaMess($e);
        }
    }

    public function enable(FindPaymentTypeRequest $request){
        try {
            app(EnablePaymentTypeAction::class)->run($request->all());
            return FunctionLib::ajaxRespondV2(true,'Success');
        } catch (\Exception $e) {
            // throw $e;
            return $this->throwExceptionViaMess($e);
        }
    }

    public function disable(FindPaymentTypeRequest $request){
        try {
            app(DisablePaymentTypeAction::class)->run($request->all());
            return FunctionLib::ajaxRespondV2(true,'Success');
        } catch (\Exception $e) {
            // throw $e;
            return $this->throwExceptionViaMess($e);
        }
    }
}
