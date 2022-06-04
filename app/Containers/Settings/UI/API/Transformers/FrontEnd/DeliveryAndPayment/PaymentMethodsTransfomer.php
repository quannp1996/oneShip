<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-09-20 03:00:38
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-10-19 16:06:07
 * @ Description: Happy Coding!
 */

namespace App\Containers\Settings\UI\API\Transformers\FrontEnd\DeliveryAndPayment;

use App\Containers\Settings\Models\PaymentType;
use App\Containers\Settings\Models\Setting;
use App\Ship\Parents\Transformers\Transformer;

class PaymentMethodsTransfomer extends Transformer
{
    /**
     * @var  array
     */
    protected array $defaultIncludes = [
    ];

    /**
     * @var  array
     */
    protected array $availableIncludes = [
    ];

    /**
     * @param Setting $entity
     * @return array
     */
    public function transform(PaymentType $entity)
    {
        $response = [
            'id' => $entity->id,
            'sort_order' => $entity->sort_order,
            'name' => $entity->desc->name,
            'short_description' => $entity->desc->short_description,
            'selected' => false
        ];

        return $response;
    }
}
