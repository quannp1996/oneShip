<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-08-01 14:57:39
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-09-20 03:07:44
 * @ Description: Happy Coding!
 */

namespace App\Containers\Settings\UI\API\Controllers\FrontEnd\DeliveryAndPayment\Features;

use App\Containers\Settings\Actions\DeliveryType\DeliveryTypeListingAction;
use App\Containers\Settings\Actions\PaymentType\PaymentTypeListingAction;
use App\Containers\Settings\Enums\DeliveryTypeStatus;
use App\Containers\Settings\Enums\PaymentTypeStatus;
use App\Containers\Settings\UI\API\Requests\FrontEnd\DeliveryAndPayment\GetPayAndDeliMethodsRequest;
use App\Containers\Settings\UI\API\Transformers\FrontEnd\DeliveryAndPayment\DeliveryMethodsTransfomer;
use App\Containers\Settings\UI\API\Transformers\FrontEnd\DeliveryAndPayment\PaymentMethodsTransfomer;
use Spatie\Fractalistic\ArraySerializer;

trait GetPayAndDeliMethods
{
    public function getPayAndDeliMethods(GetPayAndDeliMethodsRequest $request)
    {
        $paymentMethods = app(PaymentTypeListingAction::class)->run(['status' => PaymentTypeStatus::ACTIVE], $this->currentLang, 10,true);
        $deliveryTypes = app(DeliveryTypeListingAction::class)->run(['status' => DeliveryTypeStatus::ACTIVE],$this->currentLang, 10,true);

        return [
            'payment_methods' => $this->transform($paymentMethods,new PaymentMethodsTransfomer,[],[],'payment-methods'),
            'delivery_methods' => $this->transform($deliveryTypes,new DeliveryMethodsTransfomer,[],[],'delivery-methods')
        ];
    }
}
