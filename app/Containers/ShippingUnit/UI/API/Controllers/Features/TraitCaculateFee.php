<?php

namespace App\Containers\ShippingUnit\UI\API\Controllers\Features;

use App\Containers\ShippingUnit\Values\DonHang;
use App\Containers\ShippingUnit\Business\ShippingFactory;
use App\Containers\Customer\Actions\FindCustomerByIdAction;
use App\Containers\ShippingUnit\Actions\FindShippingUnitByIdAction;
use App\Containers\ShippingUnit\Actions\GetAllShippingUnitsAction;
use App\Containers\ShippingUnit\UI\API\Requests\Admin\AdminCaculateShippingFeeRequest;
use App\Containers\ShippingUnit\UI\API\Requests\FrontEnd\CaculateShippingFeesRequest;
use App\Containers\ShippingUnit\UI\API\Transformers\CaculateShippingUnitTransformer;

trait TraitCaculateFee{

    public function caculateFee(AdminCaculateShippingFeeRequest $request)
    {
        /**
         * Láy thông tin người đặt hàng
         */
        $customer = app(FindCustomerByIdAction::class)->run($request->userID);
        /**
         * Lấy thông tin của Đơn vị vận chuyển được chọn
         */
        $shippingUnit = app(FindShippingUnitByIdAction::class)->run($request->shippingID);
        /**
         * Khởi tạo Shipping API
         */
        $shippingAPI = ShippingFactory::getInstance($shippingUnit);

        $shippingFee = $shippingAPI->setDonhang(new DonHang($request->all()))
                        ->setCustomer($customer)
                        ->caculateShipping();
        return $this->sendResponse([
            'fee' => $shippingFee
        ]);
    }

    public function caculateFees(CaculateShippingFeesRequest $request)
    {

        /**
         * Láy thông tin người đặt hàng
         */

        $customer = app(FindCustomerByIdAction::class)->run($request->userID);
        /**
         * Lấy thông tin của Đơn vị vận chuyển được chọn
         */

        $shippingUnits = app(GetAllShippingUnitsAction::class)->run();

        // /**
        //  * Khởi tạo Shipping API
        //  */
        // $shippingAPI = ShippingFactory::getInstance($shippingUnit);

        // $shippingFee = $shippingAPI->setDonhang(new DonHang($request->all()))
        //                 ->setCustomer($customer)
        //                 ->caculateShipping();
        // return $this->sendResponse([
        //     'fee' => $shippingFee
        // ]);
        return $this->transform($shippingUnits, CaculateShippingUnitTransformer::class);
    }
}
